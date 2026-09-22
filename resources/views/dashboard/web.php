<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InvestmentController;
use App\Http\Controllers\LegacyController;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\TermsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WithdrawalController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn()=>redirect()->route('login'));
Route::get('/login',[AuthController::class,'showLogin'])->name('login');
Route::get('/register',[AuthController::class,'showRegister'])->name('register');
Route::post('/login',[AuthController::class,'login'])->name('login.submit');
Route::post('/register',[AuthController::class,'register'])->name('register.submit');
Route::post('/logout',[AuthController::class,'logout'])->name('logout');

Route::middleware('auth:investor')->group(function(){
    Route::get('/dashboard',[DashboardController::class,'index'])->name('dashboard');
    Route::get('/account',[LegacyController::class,'account'])->name('account');
    Route::get('/deposit',[LegacyController::class,'deposit'])->name('deposit');
    Route::get('/wallet',[WalletController::class,'index'])->name('wallet');
    Route::get('/withdraw',[WithdrawalController::class,'index'])->name('withdraw');
    Route::post('/withdraw',[WithdrawalController::class,'store'])->name('withdraw.store');

    Route::get('/investments/plans',[InvestmentController::class,'plans'])->name('investments.plans');
    Route::get('/investments/plans/{plan}',[InvestmentController::class,'create'])->name('investments.create');
    Route::post('/investments',[InvestmentController::class,'store'])->name('investments.store');
    Route::get('/investments/contracts',[InvestmentController::class,'contracts'])->name('investments.contracts');
    Route::get('/market',[InvestmentController::class,'stockMarket'])->name('market');
    Route::get('/market/{stock}',[InvestmentController::class,'stock'])->name('market.stock');
    Route::post('/market/invest',[InvestmentController::class,'applyStock'])->name('market.invest');

    Route::get('/transfer',[TransferController::class,'index'])->name('transfer');
    Route::post('/transfer/verify',[TransferController::class,'verifyReceiver'])->name('transfer.verify');
    Route::post('/transfer',[TransferController::class,'create'])->name('transfer.store');
    Route::post('/transfer/confirm',[TransferController::class,'confirm'])->name('transfer.confirm');
    Route::post('/referrals/transfer',[TransferController::class,'referralTransfer'])->name('referrals.transfer');

    Route::get('/profile',[ProfileController::class,'index'])->name('profile');
    Route::post('/profile',[ProfileController::class,'update'])->name('profile.update');
    Route::post('/profile/currency',[ProfileController::class,'currency'])->name('profile.currency');
    Route::post('/profile/image',[ProfileController::class,'image'])->name('profile.image');
    Route::post('/profile/password',[ProfileController::class,'changePassword'])->name('profile.password');

    Route::get('/notifications',[NotificationController::class,'index'])->name('notifications');
    Route::post('/notifications/seen',[NotificationController::class,'seen'])->name('notifications.seen');
    Route::get('/verification',[VerificationController::class,'index'])->name('verification');
    Route::post('/verification/upload',[VerificationController::class,'upload'])->name('verification.upload');
    Route::get('/support',[SupportController::class,'index'])->name('support');
    Route::get('/terms',[TermsController::class,'show'])->name('terms');
    Route::get('/ajax/crypto-market',[MarketController::class,'crypto'])->name('ajax.crypto');
    Route::get('/referrals',[LegacyController::class,'referral'])->name('referrals');

    // AJAX replacements for the original PHP endpoints.
    Route::get('/ajax/balance',[DashboardController::class,'balance'])->name('ajax.balance');
    Route::post('/ajax/token',[ApiController::class,'checkToken'])->name('ajax.token');
    Route::post('/ajax/pin',[ApiController::class,'checkPin'])->name('ajax.pin');
    Route::post('/ajax/receiver',[ApiController::class,'receiver'])->name('ajax.receiver');
    Route::post('/ajax/bank',[WalletController::class,'addBank'])->name('ajax.bank');
    Route::post('/ajax/proof',[WalletController::class,'uploadProof'])->name('ajax.proof');
});
