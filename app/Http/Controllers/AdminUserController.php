<?php

namespace App\Http\Controllers;

use App\Models\BankDetail;
use App\Models\CardDetail;
use App\Models\Contract;
use App\Models\Deposit;
use App\Models\Document;
use App\Models\Investor;
use App\Models\ProofDocument;
use App\Models\StockContract;
use App\Models\VerificationDocument;
use App\Models\Withdrawal;
use App\Services\AdminUserService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class AdminUserController extends Controller
{
    public function __construct(private readonly AdminUserService $service) {}

    public function show(Investor $investor)
    {
        $id = $investor->Investor_id;

        $documents = $this->forInvestor(VerificationDocument::class, $id);
        $documents = $documents->merge($this->forInvestor(ProofDocument::class, $id))->merge($this->forInvestor(Document::class, $id));
        $bankDetails = $this->forInvestor(BankDetail::class, $id);
        $cards = $this->forInvestor(CardDetail::class, $id);
        $deposits = $this->forInvestor(Deposit::class, $id);
        $withdrawals = $this->forInvestor(Withdrawal::class, $id);
        $contracts = $this->forInvestor(Contract::class, $id);
        $stockContracts = $this->forInvestor(StockContract::class, $id);
        $notifications = $this->forInvestor(\App\Models\Notification::class, $id);

        return view('manager.admin.manager-user', [
            'investor' => $investor,
            'control' => $this->service->control($investor),
            'documents' => $documents,
            'bankDetails' => $bankDetails,
            'cards' => $cards,
            'deposits' => $deposits,
            'withdrawals' => $withdrawals,
            'contracts' => $contracts,
            'stockContracts' => $stockContracts,
            'notifications' => $notifications,
            'plans' => [1,2,3,4,5],
        ]);
    }

    public function action(Request $request, Investor $investor)
    {
        $action = $request->validate([
            'action' => 'required|in:lock,unlock,verify,upgrade,deposit,profit,reduce_balance,signal,swift,notification,mail,withdrawal_ban,withdrawal_unban,delete',
            'amount' => 'nullable|numeric|min:0.01',
            'level' => 'nullable|integer|min:0|max:100',
            'signal' => 'nullable|string|max:100',
            'subject' => 'nullable|string|max:255',
            'message' => 'nullable|string|max:10000',
        ]);

        try {
            switch ($action['action']) {
                case 'lock': $this->service->lock($investor, true); $message='Account locked.'; break;
                case 'unlock': $this->service->lock($investor, false); $message='Account unlocked.'; break;
                case 'verify': $this->service->verify($investor); $message='Account manually verified.'; break;
                case 'upgrade': $this->service->upgrade($investor, (int) ($action['level'] ?? 1)); $message='Account level updated.'; break;
                case 'deposit': $this->service->recordDeposit($investor, (float) $action['amount']); $message='Deposit credited.'; break;
                case 'profit': $this->service->loadProfit($investor, (float) $action['amount']); $message='Profit loaded.'; break;
                case 'reduce_balance': $this->service->reduceBalance($investor, (float) $action['amount']); $message='Account balance reduced.'; break;
                case 'signal': $this->service->updateSignal($investor, (string) $action['signal']); $message='Signal updated.'; break;
                case 'swift': $message='SWIFT code generated: '.$this->service->generateSwiftCode($investor); break;
                case 'notification': $this->service->sendNotification($investor, (string) $action['subject'], (string) $action['message']); $message='Notification sent.'; break;
                case 'mail': $this->service->sendMail($investor, (string) $action['subject'], (string) $action['message']); $message='Email sent.'; break;
                case 'withdrawal_ban': $this->service->toggleWithdrawalBan($investor, true); $message='Withdrawals banned for this account.'; break;
                case 'withdrawal_unban': $this->service->toggleWithdrawalBan($investor, false); $message='Withdrawal ban removed.'; break;
                case 'delete': $this->service->deleteAccount($investor); return redirect()->route('admin.dashboard')->with('success', 'Investor account deleted.');
                default: throw new \RuntimeException('Unsupported action.');
            }

            return back()->with('success', $message);
        } catch (\Throwable $e) {
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    private function forInvestor(string $model, int $investorId)
    {
        try {
            $instance = new $model;
            if (!Schema::hasTable($instance->getTable()) || !Schema::hasColumn($instance->getTable(), 'Investor_id')) {
                return collect();
            }
            return $model::where('Investor_id', $investorId)->latest('id')->get();
        } catch (\Throwable) {
            return collect();
        }
    }
}
