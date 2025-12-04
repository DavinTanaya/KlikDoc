<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BmiController;
use App\Http\Controllers\ChatDokterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KalenderMenstruasiController;
use App\Http\Controllers\KalkulatorBmiContoller;
use App\Http\Controllers\PengingatObatController;
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

Route::get('/kalkulator-bmi', [KalkulatorBmiContoller::class, 'index'])->name('kalkulator_bmi');
Route::get('/pengingat-obat', [PengingatObatController::class, 'index'])->name('pengingat_obat');
Route::get('/kalender-menstruasi', [KalenderMenstruasiController::class, 'index'])->name('kalender_menstruasi');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/chat-dokter', [ChatDokterController::class, 'index'])->name('chat.index');
    Route::post('/chat-dokter/send', [ChatDokterController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chats/{chat}/call/start', [ChatDokterController::class, 'start'])->name('chats.call.start');
    Route::post('/chats/{chat}/call/end', [ChatDokterController::class, 'end'])->name('chats.call.end');
});