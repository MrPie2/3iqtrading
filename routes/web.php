<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MarketController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\ClientAuthController;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/ira', [PageController::class, 'ira'])->name('ira');
Route::get('/stocks', [PageController::class, 'stocks'])->name('stocks');
Route::get('/401k', [PageController::class, 'fourOhOneK'])->name('401k');
Route::get('/shares', [PageController::class, 'shares'])->name('shares');

Route::get('/login', [ClientAuthController::class, 'showLogin'])->name('login');
Route::post('/login', [ClientAuthController::class, 'login'])->name('login.store');

Route::get('/register', [ClientAuthController::class, 'showRegister'])->name('register');
Route::post('/register', [ClientAuthController::class, 'register'])->name('register.store');

Route::post('/logout', [ClientAuthController::class, 'logout'])->name('logout');

Route::get('/market/ticker', [MarketController::class, 'ticker']);

Route::get('/pages', [PagesController::class, 'pages'])->name('pages');
Route::get('/faqs', [FaqController::class, 'faq'])->name('faqs');

Route::get('/manager', function(){return view('/manager/auth/login');});
    
Route::middleware('guest')->group(function () {
    Route::get('/login-admin', [AuthController::class, 'showLogin'])->name('login.admin');
    Route::post('/login-admin', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('admin.session')->prefix('admin')->name('admin.')->group(function () {
    
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    foreach (array_keys(config('admin_pages.pages', [])) as $module) {
        Route::get('/modules/'.$module, [AdminController::class, 'page'])->name('module.'.$module);
        Route::post('/operations/'.$module, [AdminController::class, 'operation'])->name('operation.'.$module);
    }
});


