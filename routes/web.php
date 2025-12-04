<?php

use App\Http\Controllers\ApotekController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatDokterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HistoryDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KalenderMenstruasiController;
use App\Http\Controllers\KalkulatorBmiContoller;
use App\Http\Controllers\PengingatObatController;
use App\Http\Controllers\SuccessController;
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

Route::get('/apotek', [ApotekController::class, 'index'])->name('apotek');
Route::get('/apotek/keranjang', [CartController::class, 'index'])->name('apotek_keranjang');
Route::get('/apotek/checkout', [CheckoutController::class, 'index'])->name('apotek_checkout');
Route::get('/apotek/success', [SuccessController::class, 'index'])->name('success');
Route::get('/apotek/riwayat', [HistoryController::class, 'index'])->name('riwayat');
Route::get('/apotek/riwayat/detail', [HistoryDetailController::class, 'index'])->name('detail_pesanan');

Route::get('/admin', function () {
    return view('admin.index');
})->name('admin.index');

Route::middleware(['auth'])->group(function () {
    Route::get('/chat-dokter', [ChatDokterController::class, 'index'])->name('chat.index');
    Route::post('/chat-dokter/send', [ChatDokterController::class, 'sendMessage'])->name('chat.send');
    Route::post('/chats/{chat}/call/start', [ChatDokterController::class, 'start'])->name('chats.call.start');
    Route::post('/chats/{chat}/call/end', [ChatDokterController::class, 'end'])->name('chats.call.end');
});