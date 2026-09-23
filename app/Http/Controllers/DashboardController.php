<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use App\Models\Deposit;
use App\Models\Investment;
use App\Models\Investor;
use App\Models\Notification;
use App\Models\Referral;
use App\Models\StockContract;
use App\Models\Withdrawal;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        /** @var Investor $investor */
        $investor = Auth::guard('investor')->user();

        $contracts = Contract::where('Investor_id', $investor->Investor_id)->latest('id')->get();
        $stockContracts = StockContract::where('Investor_id', $investor->Investor_id)->latest('id')->get();
        $deposits = Deposit::where('Investor_id', $investor->Investor_id)->latest('id')->limit(5)->get();
        $withdrawals = Withdrawal::where('Investor_id', $investor->Investor_id)->latest('id')->limit(5)->get();
        $notifications = Notification::where('Investor_id', $investor->Investor_id)->where('seen', 0)->latest('id')->limit(5)->get();
        $referrals = Referral::where('Refferer', $investor->Investor_id)->get();

        $stats = [
            'balance' => (float) $investor->Total_Deposit,
            'portfolio' => (float) $investor->Fin_Asset,
            'active_investments' => $contracts->where('Status', 1)->count() + $stockContracts->where('Status', 1)->count(),
            'referral_earnings' => (float) $referrals->sum('Refferal_Earnings'),
        ];

        $chart = DB::table('data')
            ->where('user_id', $investor->Investor_id)
            ->orderBy('id')
            ->limit(30)
            ->get();

        return view('dashboard.index.index', compact(
            'investor', 'contracts', 'stockContracts', 'deposits',
            'withdrawals', 'notifications', 'referrals', 'stats', 'chart'
        ));
    }

    public function balance()
    {
        $investor = Auth::guard('investor')->user();

        return response()->json([
            'balance' => (float) $investor->Total_Deposit * (float) $investor->exchangerate,
            'currency' => $investor->curAbbr,
        ]);
    }
}