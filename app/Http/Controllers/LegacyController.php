<?php
namespace App\Http\Controllers;
use App\Models\InvestmentPlanLegacy;
use App\Models\Stock;
use Illuminate\Support\Facades\Auth;
class LegacyController extends Controller
{
    public function account(){ return view('dashboard.account',['investor'=>Auth::guard('investor')->user()]); }
    public function deposit(){ return view('wallet.deposit',['investor'=>Auth::guard('investor')->user()]); }
    public function referral(){ $investor=Auth::guard('investor')->user(); $referrals=\App\Models\Referral::where('Refferer',$investor->Investor_id)->get(); return view('dashboard.referral',compact('investor','referrals')); }
    public function wallet(){ return app(\App\Http\Controllers\WalletController::class)->index(); }
    public function withdraw(){ return app(\App\Http\Controllers\WithdrawalController::class)->index(); }
}
