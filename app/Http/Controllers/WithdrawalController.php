<?php

namespace App\Http\Controllers;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
{
    public function index()
    {
        $investor = Auth::guard('investor')->user();
        $withdrawals = Withdrawal::where('Investor_id', $investor->Investor_id)->latest('id')->get();

        return view('dashboard.wallet.withdraw', compact('investor', 'withdrawals'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'pay_to' => 'required|string|max:255',
            'bop' => 'nullable|string|max:255',
            'network' => 'nullable|string|max:255',
        ]);

        $investor = Auth::guard('investor')->user();
        $amount = (float) $data['amount'];
        $rate = max((float) $investor->exchangerate, 0.000001);
        $available = (float) $investor->Fin_Asset * $rate;

        if ($amount > $available) {
            return response()->json(['ok' => false, 'code' => 2, 'message' => 'Insufficient portfolio balance.'], 422);
        }

        DB::transaction(function () use ($data, $investor, $amount, $rate) {
            Withdrawal::create([
                'Investor_id' => $investor->Investor_id,
                'Amount_Withdrawn' => $amount / $rate,
                'walletaddress' => $data['pay_to'],
                'BOP' => $data['bop'] ?? '',
                'Network' => $data['network'] ?? '',
                'Destination' => 'Account Balance',
                'Status' => 0,
                'Date' => now()->format('l d F Y'),
            ]);

            $investor->decrement('Fin_Asset', $amount / $rate);
        });

        return response()->json(['ok' => true, 'message' => 'Withdrawal request submitted.']);
    }
}