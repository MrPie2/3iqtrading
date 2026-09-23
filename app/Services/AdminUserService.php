<?php

namespace App\Services;

use App\Models\AdminUserControl;
use App\Models\BankDetail;
use App\Models\CardDetail;
use App\Models\Contract;
use App\Models\Deposit;
use App\Models\Document;
use App\Models\Investor;
use App\Models\Notification;
use App\Models\ProofDocument;
use App\Models\StockContract;
use App\Models\VerificationDocument;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

class AdminUserService
{
    public function control(Investor $investor): AdminUserControl
    {
        return AdminUserControl::firstOrCreate(
            ['investor_id' => (int) $investor->Investor_id],
            ['withdrawal_banned' => false]
        );
    }

    public function lock(Investor $investor, bool $locked): void
    {
        $investor->update(['LockStatus' => $locked ? 1 : 0]);
    }

    public function verify(Investor $investor): void
    {
        $investor->update(['V_Status' => 1]);
    }

    public function upgrade(Investor $investor, int $level): void
    {
        $investor->update(['Level' => $level]);
    }

    public function adjustBalance(Investor $investor, float $amount, string $type): void
    {
        $column = $type === 'profit' ? 'Fin_Asset' : 'Total_Deposit';

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
        $this->adjustBalance($investor, $amount, 'balance');
        $this->recordTransaction(Deposit::class, $investor, $amount, 'Amount_Deposited');
    }

    public function loadProfit(Investor $investor, float $amount): void
    {
        $this->adjustBalance($investor, $amount, 'profit');
    }

    public function reduceBalance(Investor $investor, float $amount): void
    {
        if ($amount <= 0) {
            throw new \InvalidArgumentException('Amount must be greater than zero.');
        }

        $this->adjustBalance($investor, -$amount, 'balance');
    }

    private function recordTransaction(string $model, Investor $investor, float $amount, string $amountColumn): void
    {
        if (!Schema::hasTable((new $model)->getTable())) {
            return;
        }

        $table = (new $model)->getTable();
        $columns = array_flip(Schema::getColumnListing($table));
        $data = [];

        foreach ([
            'Investor_id' => $investor->Investor_id,
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

    public function updateSignal(Investor $investor, string $signal): void
    {
        $control = $this->control($investor);
        $control->update(['signal' => $signal]);
    }

    public function generateSwiftCode(Investor $investor): string
    {
        $control = $this->control($investor);
        $code = strtoupper(Str::random(11));
        $control->update(['swift_code' => $code]);

        if (Schema::hasColumn('investors', 'swift_code')) {
            $investor->update(['swift_code' => $code]);
        }

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
            'Investor_id' => $investor->Investor_id,
            'Subject' => $subject,
            'Text' => $text,
            'seen' => 0,
            'Date' => now(),
        ] as $column => $value) {
            if (isset($columns[$column])) {
                $data[$column] = $value;
            }
        }

        DB::table($table)->insert($data);
    }

    public function sendMail(Investor $investor, string $subject, string $body): void
    {
        $email = trim((string) $investor->Email);
        if ($email === '') {
            throw new \RuntimeException('This investor does not have an email address.');
        }

        Mail::raw($body, function ($message) use ($email, $subject) {
            $message->to($email)->subject($subject);
        });
    }

    public function toggleWithdrawalBan(Investor $investor, bool $banned): void
    {
        $this->control($investor)->update(['withdrawal_banned' => $banned]);
    }

    public function deleteAccount(Investor $investor): void
    {
        DB::transaction(function () use ($investor) {
            $id = $investor->Investor_id;

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
                Document::class,
            ] as $model) {
                try {
                    $instance = new $model;
                    if (Schema::hasTable($instance->getTable()) && Schema::hasColumn($instance->getTable(), 'Investor_id')) {
                        $model::where('Investor_id', $id)->delete();
                    }
                } catch (\Throwable $e) {
                    Log::warning('Admin account cleanup skipped', [
                        'table' => isset($instance) ? $instance->getTable() : $model,
                        'investor_id' => $id,
                        'error' => $e->getMessage(),
                    ]);
                }
            }

            AdminUserControl::where('investor_id', $id)->delete();
            $investor->delete();
        });
    }
}
