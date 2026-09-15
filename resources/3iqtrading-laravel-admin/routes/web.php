<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', fn () => redirect()->route('login'));

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.submit');
});

Route::middleware('admin.session')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::post('/logout', [AdminController::class, 'logout'])->name('logout');

    // Every legacy Manager PHP page is addressable from Laravel.
    foreach (array_keys(config('admin_pages.pages', [])) as $module) {
        Route::get('/modules/'.$module, [AdminController::class, 'page'])->name('module.'.$module);
        Route::post('/operations/'.$module, [AdminController::class, 'operation'])->name('operation.'.$module);
    }
});
