<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->middleware('auth')->name('home');

Route::prefix('auth')->group(function () {
    Route::middleware('guest')->group(function () {
        Route::get('/login', [AuthController::class, 'getLogin'])->name('login');
        Route::post('/register', [AuthController::class, 'register'])->name('register.post');
        Route::post('/login', [AuthController::class, 'login'])->name('login.post');
        Route::get('google', [AuthController::class, 'redirectToGoogle'])->name('google.login');
        Route::get('google/callback', [AuthController::class, 'handleGoogleCallback']);
    });
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});
