<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ApotekController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\ChatDokterController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ConsultationController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\DokterJadwalPraktikController;
use App\Http\Controllers\DrugController;
use App\Http\Controllers\HistoryDetailController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlikHomeController;
use App\Http\Controllers\KlikHomeHistoryController;
use App\Http\Controllers\KlikHomePaymentController;
use App\Http\Controllers\MandiriBmiController;
use App\Http\Controllers\MandiriController;
use App\Http\Controllers\MandiriKehamilanController;
use App\Http\Controllers\MandiriMenstruasiController;
use App\Http\Controllers\MandiriObatController;
use App\Http\Controllers\OrderController;
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

Route::get('/kalkulator-bmi', [MandiriController::class, 'bmi'])->name('kalkulator_bmi');
Route::post('/kalkulator-bmi', [MandiriController::class, 'calculateBmi'])->name('kalkulator_bmi.hitung');
Route::get('/pengingat-obat', [MandiriController::class, 'pengingatObat'])->name('pengingat_obat');
Route::get('/kalender-menstruasi', [MandiriController::class, 'kalenderMenstruasi'])->name('kalender_menstruasi');
Route::get('/kalender-kehamilan', [MandiriController::class, 'kalenderKehamilan'])->name('kalender_kehamilan');

Route::get('/apotek', [ApotekController::class, 'index'])->name('apotek');
Route::get('/apotek/keranjang', [CartController::class, 'index'])->name('apotek_keranjang');
Route::post('/apotek/keranjang/selected', [CartController::class, 'removeSelectedCart'])->name('apotek_keranjang.delete_selected');
Route::post('/apotek/keranjang/{id}', [CartController::class, 'addCart'])->name('apotek_keranjang.post');
Route::patch('/apotek/keranjang/{id}', [CartController::class, 'updateCart'])->name('apotek_keranjang.update');
Route::delete('/apotek/keranjang/{id}', [CartController::class, 'removeCart'])->name('apotek_keranjang.delete');
Route::get('/apotek/checkout', [CheckoutController::class, 'index'])->name('apotek.checkout');
Route::get('/apotek/checkout/from-prescription/{prescriptionId}', [CheckoutController::class, 'fromPrescription'])->name('apotek.fromPrescription');
Route::post('/apotek/checkout/pay', [CheckoutController::class, 'pay'])->name('apotek.checkout.pay');
Route::get('/apotek/checkout/retry/{code}', [CheckoutController::class, 'retry'])->name('apotek.checkout.retry');
Route::get('/apotek/checkout/success/{code}', [CheckoutController::class, 'success'])->name('apotek.checkout.success');
Route::post('/apotek/checkout/use-voucher', [CheckoutController::class, 'useVoucher'])->name('apotek.checkout.use_voucher');
Route::get('/apotek/riwayat/detail', [HistoryDetailController::class, 'index'])->name('detail_pesanan');

Route::get('/konsultasi', [ConsultationController::class, 'getConsultation'])->name('konsultasi');
Route::get('/konsultasi/detail/{id}', [ConsultationController::class, 'getConsultationDetail'])->name('konsultasi.detail');
Route::post('/konsultasi/bayar/{id}', [ConsultationController::class, 'payConsultation'])->name('konsultasi.bayar');
Route::get('/konsultasi/retry/{code}', [ConsultationController::class, 'retryPayment'])->name('konsultasi.retry');
Route::get('/konsultasi/success/{code}', [ConsultationController::class, 'paymentSuccess'])->name('konsultasi.success');
Route::get('/konsultasi/riwayat', [ConsultationController::class, 'getHistory'])->name('konsultasi.riwayat');
Route::get('/konsultasi/riwayat/{id}', [ConsultationController::class, 'getDetail'])->name('konsultasi.riwayat.detail');
Route::post('/konsultasi/riwayat/{id}/beri-rating', [ConsultationController::class, 'giveRating'])->name('konsultasi.rating.store');

Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel');
Route::get('/artikel/detail/{article}', [ArticleController::class, 'detail'])->name('artikel.detail');

Route::get('/artikel/create', [ArticleController::class, 'create'])->name('article.create');
Route::post('/artikel', [ArticleController::class, 'store'])->name('article.store');
Route::get('/artikel/list', [ArticleController::class, 'articleList'])->name('article.index');
Route::get('/artikel/{article}/edit', [ArticleController::class, 'edit'])
  ->name('article.edit');

Route::put('/artikel/{article}', [ArticleController::class, 'update'])
  ->name('article.update');

Route::post('/artikel/{article}/approve', [ArticleController::class, 'approve'])->name('article.approve');

Route::post('/artikel/{article}/unpublish', [ArticleController::class, 'unpublish'])->name('article.unpublish');


Route::get('/klik-home', [KlikHomeController::class, 'index'])->name('klik-home');
Route::get('/klik-home/detail', [KlikHomeController::class, 'detail'])->name('klik-home.detail');
Route::get('/klik-home/pembayaran', [KlikHomePaymentController::class, 'payment'])->name('klik-home.payment');
Route::get('/klik-home/sukses', [KlikHomePaymentController::class, 'success'])->name('klik-home.payment.success');
Route::get('klik-home/riwayat', [KlikHomeHistoryController::class, 'index'])->name('klik-home.riwayat');
Route::get('klik-home/riwayat/detail', [KlikHomeHistoryController::class, 'detail'])->name('klik-home.riwayat.detail');


Route::get('/dokter', [DoctorController::class, 'index'])->name('dokter.dashboard');
Route::get('/dokter/pendaftaran', [DoctorController::class, 'registerIndex'])->name('dokter.pendaftaran');
Route::post('/dokter/pendaftaran', [DoctorController::class, 'register'])->name('dokter.register');
Route::get('/dokter/riwayat', [DoctorController::class, 'getHistory'])->name('dokter.riwayat');
Route::get('/dokter/jadwal-praktik', [DokterJadwalPraktikController::class, 'index'])->name('dokter.jadwal-praktik');
Route::get('/dokter/rujukan', [DoctorController::class, 'getRefferal'])->name('dokter.rujukan');
// routes/web.php
Route::post('/dokter/rujukan/store', [DoctorController::class, 'storeRefferal'])->name('dokter.rujukan.store');
Route::get('/rujukan/{referral}/download', [DoctorController::class, 'downloadRefferal'])->name('referral.download');


Route::get('/dokter/chat', [ChatDokterController::class, 'index'])->name('dokter.chat.index');
Route::post('/dokter/prescription-chat/{consultationId}',[ConsultationController::class, 'createPrescriptionChat'])->name('dokter.prescription.chat');
Route::post('/dokter/finish/{consultationId}',[ConsultationController::class, 'finishConsultation'])->name('dokter.consultation.finish');




Route::middleware(['auth', 'isAdmin'])->group(function () {
    Route::get('/admin', function () {
        return view('admin.index');
    })->name('admin.index');
    Route::post('/admin/drugs/create', [DrugController::class, 'createDrug'])->name('admin.drugs.create');
    Route::put('/admin/drugs/{id}', [DrugController::class, 'editDrug'])->name('admin.drugs.update');
    Route::delete('/admin/drugs/{id}', [DrugController::class, 'deleteDrug'])->name('admin.drugs.delete');
    Route::get('/admin/orders/history', [AdminController::class, 'drugOrderHistory'])
    ->name('admin.orders.history');
    Route::get('/admin/orders/{code}', [AdminController::class, 'drugOrderDetail'])
    ->name('admin.orders.detail');
    Route::patch('/admin/orders/{code}', [AdminController::class, 'updateOrder'])
    ->name('admin.orders.update');

});



Route::middleware(['auth'])->group(function () {
    Route::get('/chat-dokter', [ChatDokterController::class, 'index'])->name('chat.index');
    Route::post('/chat-dokter/send', [ChatDokterController::class, 'sendMessage'])->name('chat.send');
    Route::get('/chat/messages/{chat}', [ChatDokterController::class, 'messages'])->name('chat.messages');
    Route::post('/chats/{chat}/call/start', [ChatDokterController::class, 'start'])->name('chats.call.start');
    Route::post('/chats/{chat}/call/end', [ChatDokterController::class, 'end'])->name('chats.call.end');
});

Route::get('/admin/apotek/html',[AdminController::class, 'getApotekHtml']);
Route::get('/admin/dokter/html',[AdminController::class, 'getDokterHtml']);

Route::get('/admin/applications/update-status/{id}', [AdminController::class, 'updateApplicationStatus'])->name('admin.applications.update_status');
Route::get('/admin/applicants/history', [AdminController::class, 'applicantHistory'])->name('admin.applicants.history');

Route::post('/address', [UserController::class, 'storeAddress'])->name('address.store');
Route::post('/address/set-default', [UserController::class, 'setDefaultAddress'])->name('address.set_default');

Route::put('/address/{id}', [UserController::class, 'editAddress'])->name('address.update');

Route::get('/orders/history', [OrderController::class, 'history'])->name('orders.history');
Route::get('/orders/{code}', [OrderController::class, 'detail'])->name('orders.detail');

Route::get( '/prescription/{id}/download',[ConsultationController::class, 'download'])->name('resep.download');