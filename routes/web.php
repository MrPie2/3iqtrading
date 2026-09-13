<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/ira', [PageController::class, 'ira'])->name('ira');
Route::get('/stocks', [PageController::class, 'stocks'])->name('stocks');
Route::get('/401k', [PageController::class, 'fourOhOneK'])->name('401k');
Route::get('/shares', [PageController::class, 'shares'])->name('shares');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.store');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.store');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
