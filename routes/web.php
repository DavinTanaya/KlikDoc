<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApotekController;
use App\Http\Controllers\ArtikelController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatDokterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\DokterChatController;
use App\Http\Controllers\DokterDashboardController;
use App\Http\Controllers\DokterHistoryController;
use App\Http\Controllers\DokterJadwalPraktikController;
use App\Http\Controllers\DokterPendaftaranController;
use App\Http\Controllers\DokterRujukanController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\HistoryDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KalenderMenstruasiController;
use App\Http\Controllers\KalkulatorBmiContoller;
use App\Http\Controllers\KlikHomeController;
use App\Http\Controllers\KlikHomeHistoryController;
use App\Http\Controllers\KlikHomePaymentController;
use App\Http\Controllers\KonsultasiDokterController;
use App\Http\Controllers\KonsultasiDokterDetailController;
use App\Http\Controllers\KonsultasiDokterSuccessController;
use App\Http\Controllers\KonsultasiHistoryController;
use App\Http\Controllers\KonsultasiHistoryDetailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PengingatObatController;
use App\Http\Controllers\SuccessController;
use App\Http\Controllers\UserController;
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
Route::post('/apotek/keranjang/selected', [CartController::class, 'removeSelectedCart'])->name('apotek_keranjang.delete_selected');
Route::post('/apotek/keranjang/{id}', [CartController::class, 'addCart'])->name('apotek_keranjang.post');
Route::patch('/apotek/keranjang/{id}', [CartController::class, 'updateCart'])->name('apotek_keranjang.update');
Route::delete('/apotek/keranjang/{id}', [CartController::class, 'removeCart'])->name('apotek_keranjang.delete');
Route::get('/apotek/checkout', [CheckoutController::class, 'index'])->name('apotek.checkout');
Route::post('/apotek/checkout/pay', [CheckoutController::class, 'pay'])->name('apotek.checkout.pay');
Route::get('/apotek/checkout/retry/{code}', [CheckoutController::class, 'retry'])->name('apotek.checkout.retry');
Route::get('/apotek/checkout/success/{code}', [CheckoutController::class, 'success'])->name('apotek.checkout.success');
Route::post('/apotek/checkout/use-voucher', [CheckoutController::class, 'useVoucher'])->name('apotek.checkout.use_voucher');

Route::get('/apotek/riwayat/detail', [HistoryDetailController::class, 'index'])->name('detail_pesanan');

Route::get('/konsultasi', [KonsultasiDokterController::class, 'index'])->name('konsultasi');
Route::get('/konsultasi/detail', [KonsultasiDokterController::class, 'detail'])->name('konsultasi.detail');
Route::get('/konsultasi/success', [KonsultasiDokterController::class, 'success'])->name('konsultasi.success');
Route::get('/konsultasi/riwayat', [KonsultasiHistoryController::class, 'index'])->name('konsultasi.riwayat');
Route::get('/konsultasi/riwayat/detail', [KonsultasiHistoryController::class, 'detail'])->name('konsultasi.riwayat.detail');

Route::get('/artikel', [ArtikelController::class, 'index'])->name('artikel');
Route::get('/artikel/detail', [ArtikelController::class, 'detail'])->name('artikel.detail');

Route::get('/klik-home', [KlikHomeController::class, 'index'])->name('klik-home');
Route::get('/klik-home/detail', [KlikHomeController::class, 'detail'])->name('klik-home.detail');
Route::get('/klik-home/pembayaran', [KlikHomePaymentController::class, 'payment'])->name('klik-home.payment');
Route::get('/klik-home/sukses', [KlikHomePaymentController::class, 'success'])->name('klik-home.payment.success');
Route::get('klik-home/riwayat', [KlikHomeHistoryController::class, 'index'])->name('klik-home.riwayat');
Route::get('klik-home/riwayat/detail', [KlikHomeHistoryController::class, 'detail'])->name('klik-home.riwayat.detail');


Route::get('/dokter', [DokterDashboardController::class, 'index'])->name('dokter.dashboard');
Route::get('/dokter/pendaftaran', [DokterPendaftaranController::class, 'index'])->name('dokter.pendaftaran');
Route::get('/dokter/jadwal-praktik', [DokterJadwalPraktikController::class, 'index'])->name('dokter.jadwal-praktik');
Route::get('/dokter/rujukan', [DokterRujukanController::class, 'index'])->name('dokter.rujukan');
Route::get('/dokter/riwayat', [DokterHistoryController::class, 'index'])->name('dokter.riwayat');
Route::get('/dokter/chat', [DokterChatController::class, 'index'])->name('dokter.chat');

Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
    Route::post('/admin/drugs/create', [DrugController::class, 'createDrug'])->name('admin.drugs.create');
    Route::put('/admin/drugs/{id}', [DrugController::class, 'editDrug'])->name('admin.drugs.update');
    Route::delete('/admin/drugs/{id}', [DrugController::class, 'deleteDrug'])->name('admin.drugs.delete');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/chat-dokter', [ChatDokterController::class, 'index'])->name('chat.index');
    Route::post('/chat-dokter/send', [ChatDokterController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/messages/{chat}', [ChatDokterController::class, 'messages'])->name('chat.messages');
    Route::post('/chats/{chat}/call/start', [ChatDokterController::class, 'start'])->name('chats.call.start');
    Route::post('/chats/{chat}/call/end', [ChatDokterController::class, 'end'])->name('chats.call.end');
});

Route::get('/admin/apotek/html',[AdminController::class, 'getApotekHtml']);


Route::post('/address', [UserController::class, 'storeAddress'])->name('address.store');
Route::post('/address/set-default', [UserController::class, 'setDefaultAddress'])->name('address.set_default');

Route::put('/address/{id}', [UserController::class, 'editAddress'])->name('address.update');

Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
Route::get('/orders/{code}', [OrderController::class, 'detail'])->name('orders.detail');
