<?php

namespace App\Http\Controllers;

use App\Models\Referral;
use Illuminate\Support\Facades\Auth;

class LegacyController extends Controller
{
    public function account()
    {
        $investor = Auth::guard('investor')->user();
        return view('dashboard.index.account', compact('investor'));
    }

    public function deposit()
    {
        $investor = Auth::guard('investor')->user();
        return view('dashboard.wallet.deposit', compact('investor'));
    }

    public function referral()
    {
        $investor = Auth::guard('investor')->user();
        $referrals = Referral::where('Refferer', $investor->Investor_id)->get();

        return view('dashboard.index.referral', compact('investor', 'referrals'));
    }
}