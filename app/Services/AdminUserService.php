<?php

namespace App\Services;

use App\Models\BankDetail;
use App\Models\CardDetail;
use App\Models\Contract;
use App\Models\Deposit;
use App\Models\Investor;
use App\Models\Notification;
use App\Models\ProofDocument;
use App\Models\StockContract;
use App\Models\VerificationDocument;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminUserService
{
    public function __construct(private readonly MailerService $mailer) {}

    public function investorId(Investor $investor): int
    {
        return (int) ($investor->Investor_id ?? $investor->id);
    }

    public function lock(Investor $investor, bool $locked): void
    {
        $this->updateExistingColumn($investor, 'LockStatus', $locked ? 1 : 0);
    }

    public function verify(Investor $investor): void
    {
        $this->updateExistingColumn($investor, 'V_Status', 1);
    }

    public function upgrade(Investor $investor, int $level): void
    {
        $this->updateExistingColumn($investor, 'Level', $level);
    }

    public function adjustBalance(Investor $investor, float $amount, string $type): void
    {
        $column = $type === 'profit' ? 'Fin_Asset' : 'Total_Deposit';

        if (!Schema::hasColumn('investors', $column)) {
            throw new \RuntimeException("The investors table does not contain {$column}.");
        }

        DB::transaction(function () use ($investor, $amount, $column) {
            $fresh = Investor::whereKey($investor->getKey())->lockForUpdate()->firstOrFail();
            $current = (float) ($fresh->{$column} ?? 0);
            $next = $current + $amount;

            if ($next < 0) {
                throw new \RuntimeException('The adjustment would make the account balance negative.');
            }

            $fresh->update([$column => round($next, 2)]);
        });
    }

    public function recordDeposit(Investor $investor, float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than zero.');
        }

        DB::transaction(function () use ($investor, $amount) {
            $this->adjustBalance($investor, $amount, 'balance');
            $this->recordTransaction(Deposit::class, $investor, $amount, 'Amount_Deposited');
        });

        $fresh = Investor::findOrFail($investor->getKey());
        $this->sendTransactionMail($fresh, $amount, 'deposit', (float) ($fresh->Total_Deposit ?? 0));
    }

    public function loadProfit(Investor $investor, float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than zero.');
        }

        $this->adjustBalance($investor, $amount, 'profit');

        $fresh = Investor::findOrFail($investor->getKey());
        $this->sendTransactionMail($fresh, $amount, 'profit', (float) ($fresh->Fin_Asset ?? 0));
    }

    public function reduceBalance(Investor $investor, float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than zero.');
        }

        $this->adjustBalance($investor, -$amount, 'profit');
    }

    public function updateSignal(Investor $investor, string $signal): void
    {
        $this->updateExistingColumn($investor, 'signal', $signal);
    }

    public function generateSwiftCode(Investor $investor): string
    {
        if (!Schema::hasColumn('investors', 'swift_code')) {
            throw new \RuntimeException('The investors table does not contain a swift_code column. No separate admin table will be created for this value.');
        }

        $code = strtoupper(Str::random(11));
        $investor->update(['swift_code' => $code]);

        return $code;
    }

    public function sendNotification(Investor $investor, string $subject, string $text): void
    {
        $table = (new Notification)->getTable();
        if (!Schema::hasTable($table)) {
            throw new \RuntimeException('The notification table is not available.');
        }

        $columns = array_flip(Schema::getColumnListing($table));
        $data = [];

        foreach ([
            'Investor_id' => $this->investorId($investor),
            'Subject' => $subject,
            'Text' => $text,
            'seen' => 0,
            'Date' => now(),
        ] as $column => $value) {
            if (isset($columns[$column])) {
                $data[$column] = $value;
            }
        }

        if (!$data) {
            throw new \RuntimeException('No compatible notification columns were found.');
        }

        DB::table($table)->insert($data);
    }

    public function sendMail(Investor $investor, string $subject, string $body, ?string $recipientEmail = null): void
    {
        $email = trim((string) ($recipientEmail ?: $investor->Email));

        if ($email === '' || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new \RuntimeException('A valid recipient email address is required.');
        }

        $recipientName = trim((string) (
            $investor->Username
            ?? $investor->Name
            ?? $investor->First_Name
            ?? 'Investor'
        )) ?: 'Investor';

        $this->mailer->send($email, $subject, $body, [
            'recipientName' => $recipientName,
            'reference' => '3IQ-' . strtoupper(substr(sha1($this->investorId($investor) . $email . now()->format('YmdHisv')), 0, 10)),
        ]);
    }

    private function sendTransactionMail(Investor $investor, float $amount, string $type, float $balance): void
    {
        $email = trim((string) $investor->Email);

        if ($email === '') {
            Log::warning('Transaction email skipped: investor has no email address.', [
                'investor_id' => $this->investorId($investor),
                'type' => $type,
            ]);
            return;
        }

        $recipientName = trim((string) (
            $investor->Username
            ?? $investor->Name
            ?? $investor->First_Name
            ?? 'Investor'
        )) ?: 'Investor';

        $currency = trim((string) ($investor->curAbbr ?? 'USD'));
        $reference = '3IQ-' . strtoupper(substr(sha1($this->investorId($investor) . $type . now()->format('YmdHisv')), 0, 10));
        $isDeposit = $type === 'deposit';

        $subject = $isDeposit
            ? 'Deposit credited to your 3IQTrading account'
            : 'Profit loaded into your 3IQTrading account';

        $body = $isDeposit
            ? "A deposit of {$currency} " . number_format($amount, 2) . " has been credited to your account. Your updated deposit balance is {$currency} " . number_format($balance, 2) . "."
            : "A profit of {$currency} " . number_format($amount, 2) . " has been loaded into your account. Your updated profit balance is {$currency} " . number_format($balance, 2) . ".";

        try {
            $this->mailer->send($email, $subject, $body, [
                'recipientName' => $recipientName,
                'reference' => $reference,
                'transactionType' => $isDeposit ? 'Deposit' : 'Profit',
                'transactionAmount' => $amount,
                'transactionBalance' => $balance,
                'transactionCurrency' => $currency,
            ]);
        } catch (\Throwable $e) {
            Log::error('Automatic transaction email failed.', [
                'investor_id' => $this->investorId($investor),
                'email' => $email,
                'type' => $type,
                'amount' => $amount,
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function toggleWithdrawalBan(Investor $investor, bool $banned): void
    {
        if (!Schema::hasColumn('investors', 'withdrawal_banned')) {
            throw new \RuntimeException('The investors table does not contain a withdrawal_banned column.');
        }

        $investor->update(['withdrawal_banned' => $banned ? 1 : 0]);
    }

    public function deleteAccount(Investor $investor): void
    {
        DB::transaction(function () use ($investor) {
            $id = $this->investorId($investor);

            foreach ([
                Withdrawal::class,
                Deposit::class,
                Notification::class,
                VerificationDocument::class,
                ProofDocument::class,
                BankDetail::class,
                CardDetail::class,
                Contract::class,
                StockContract::class,
            ] as $model) {
                try {
                    $instance = new $model;
                    $table = $instance->getTable();

                    if (Schema::hasTable($table) && Schema::hasColumn($table, 'Investor_id')) {
                        $model::where('Investor_id', $id)->delete();
                    }
                } catch (\Throwable $e) {
                    Log::warning('Admin account cleanup skipped', [
                        'model' => $model,
                        'investor_id' => $id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            $investor->delete();
        });
    }

    private function updateExistingColumn(Investor $investor, string $column, mixed $value): void
    {
        if (!Schema::hasColumn('investors', $column)) {
            throw new \RuntimeException("The investors table does not contain {$column}.");
        }

        $investor->update([$column => $value]);
    }

    private function recordTransaction(string $model, Investor $investor, float $amount, string $amountColumn): void
    {
        $instance = new $model;
        $table = $instance->getTable();

        if (!Schema::hasTable($table)) {
            return;
        }

        $columns = array_flip(Schema::getColumnListing($table));
        $data = [];

        foreach ([
            'Investor_id' => $this->investorId($investor),
            $amountColumn => $amount,
            'Status' => 1,
            'Date' => now(),
            'Created_at' => now(),
            'created_at' => now(),
        ] as $column => $value) {
            if (isset($columns[$column])) {
                $data[$column] = $value;
            }
        }

        if ($data) {
            DB::table($table)->insert($data);
        }
    }
}
