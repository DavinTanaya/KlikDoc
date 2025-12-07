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
use App\Http\Controllers\DrugController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\KlikHomeController;
use App\Http\Controllers\MandiriController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/artikel', [ArticleController::class, 'index'])->name('artikel');
Route::get('/artikel/detail/{article}', [ArticleController::class, 'detail'])->name('artikel.detail');

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

Route::middleware('auth')->group(function () {
    Route::prefix('mandiri')->group(function () {
        Route::get('/kalkulator-bmi', [MandiriController::class, 'bmi'])->name('mandiri.kalkulator_bmi');
        Route::post('/kalkulator-bmi', [MandiriController::class, 'calculateBmi'])->name('mandiri.kalkulator_bmi.hitung');
        Route::get('/pengingat-obat', [MandiriController::class, 'pengingatObat'])->name('mandiri.pengingat_obat');
        Route::get('/kalender-menstruasi', [MandiriController::class, 'kalenderMenstruasi'])->name('mandiri.kalender_menstruasi');
        Route::get('/kalender-kehamilan', [MandiriController::class, 'kalenderKehamilan'])->name('mandiri.kalender_kehamilan');
    });

    Route::prefix('apotek')->group(function () {
        Route::get('/', [ApotekController::class, 'index'])->name('apotek');
        Route::prefix('keranjang')->group(function () {
            Route::get('/', [CartController::class, 'index'])->name('apotek_keranjang');
            Route::post('/selected', [CartController::class, 'removeSelectedCart'])->name('apotek_keranjang.delete_selected');
            Route::post('/{id}', [CartController::class, 'addCart'])->name('apotek_keranjang.post');
            Route::patch('/{id}', [CartController::class, 'updateCart'])->name('apotek_keranjang.update');
            Route::delete('/{id}', [CartController::class, 'removeCart'])->name('apotek_keranjang.delete');
        });
        Route::prefix('checkout')->group(function () {
            Route::get('/', [CheckoutController::class, 'index'])->name('apotek.checkout');
            Route::get('/from-prescription/{prescriptionId}', [CheckoutController::class, 'fromPrescription'])->name('apotek.fromPrescription');
            Route::post('/pay', [CheckoutController::class, 'pay'])->name('apotek.checkout.pay');
            Route::get('/retry/{code}', [CheckoutController::class, 'retry'])->name('apotek.checkout.retry');
            Route::get('/success/{code}', [CheckoutController::class, 'success'])->name('apotek.checkout.success');
            Route::post('/use-voucher', [CheckoutController::class, 'useVoucher'])->name('apotek.checkout.use_voucher');
        });
    });

    Route::prefix('konsultasi')->group(function () {
        Route::get('/', [ConsultationController::class, 'getConsultation'])->name('konsultasi');
        Route::get('/detail/{id}', [ConsultationController::class, 'getConsultationDetail'])->name('konsultasi.detail');
        Route::post('/bayar/{id}', [ConsultationController::class, 'payConsultation'])->name('konsultasi.bayar');
        Route::get('/retry/{code}', [ConsultationController::class, 'retryPayment'])->name('konsultasi.retry');
        Route::get('/success/{code}', [ConsultationController::class, 'paymentSuccess'])->name('konsultasi.success');
        Route::get('/riwayat', [ConsultationController::class, 'getHistory'])->name('konsultasi.riwayat');
        Route::get('/riwayat/{id}', [ConsultationController::class, 'getDetail'])->name('konsultasi.riwayat.detail');
        Route::post('/riwayat/{id}/beri-rating', [ConsultationController::class, 'giveRating'])->name('konsultasi.rating.store');
    });

    Route::prefix('artikel')->group(function () {
        Route::get('/create', [ArticleController::class, 'create'])->name('article.create');
        Route::post('/', [ArticleController::class, 'store'])->name('article.store');
        Route::get('/list', [ArticleController::class, 'articleList'])->name('article.index');
        Route::prefix('{article}')->group(function () {
            Route::get('/edit', [ArticleController::class, 'edit'])->name('article.edit');
            Route::put('/', [ArticleController::class, 'update'])->name('article.update');
            Route::post('/approve', [ArticleController::class, 'approve'])->name('article.approve');
            Route::post('/unpublish', [ArticleController::class, 'unpublish'])->name('article.unpublish');
        });
    });

    Route::prefix('klik-home')->group(function () {
        Route::get('/', [KlikHomeController::class, 'index'])->name('klik-home');
        Route::get('/detail/{service}', [KlikHomeController::class, 'detail'])->name('klik-home.detail');
        Route::get('/riwayat', [KlikHomeController::class, 'history'])->name('klik-home.riwayat');
        Route::get('/riwayat/detail', [KlikHomeController::class, 'detailHistory'])->name('klik-home.riwayat.detail');
        Route::post('/{service}/pay', [KlikHomeController::class, 'pay'])->name('klikhome.pay');
        Route::prefix('payment')->group(function () {
            Route::get('/success/{orderCode}', [KlikHomeController::class, 'success'])->name('klikhome.success');
            Route::get('/retry/{orderCode}', [KlikHomeController::class, 'retry'])->name('klikhome.retry');
        });
    });

    Route::prefix('dokter')->group(function () {
        Route::get('/', [DoctorController::class, 'index'])->name('dokter.dashboard');
        Route::get('/pendaftaran', [DoctorController::class, 'registerIndex'])->name('dokter.pendaftaran');
        Route::post('/pendaftaran', [DoctorController::class, 'register'])->name('dokter.register');
        Route::get('/riwayat', [DoctorController::class, 'getHistory'])->name('dokter.riwayat');
        Route::get('/rujukan', [DoctorController::class, 'getRefferal'])->name('dokter.rujukan');
        Route::post('/rujukan/store', [DoctorController::class, 'storeRefferal'])->name('dokter.rujukan.store');
        Route::get('/rujukan/{referral}/download', [DoctorController::class, 'downloadRefferal'])->name('referral.download');
        Route::get('/chat', [ChatDokterController::class, 'index'])->name('dokter.chat.index');
        Route::post('/prescription-chat/{consultationId}', [ConsultationController::class, 'createPrescriptionChat'])->name('dokter.prescription.chat');
        Route::post('/finish/{consultationId}', [ConsultationController::class, 'finishConsultation'])->name('dokter.consultation.finish');
    });

    Route::middleware(['isAdmin'])->group(function () {
        Route::get('/admin', function () {
            return view('admin.index');
        })->name('admin.index');
        Route::prefix('admin/drugs')->group(function () {
            Route::post('/create', [DrugController::class, 'createDrug'])->name('admin.drugs.create');
            Route::put('/{id}', [DrugController::class, 'editDrug'])->name('admin.drugs.update');
            Route::delete('/{id}', [DrugController::class, 'deleteDrug'])->name('admin.drugs.delete');
        });
        Route::prefix('admin/orders')->group(function () {
            Route::get('/history', [AdminController::class, 'drugOrderHistory'])->name('admin.orders.history');
            Route::get('/{code}', [AdminController::class, 'drugOrderDetail'])->name('admin.orders.detail');
            Route::patch('/{code}', [AdminController::class, 'updateOrder'])->name('admin.orders.update');
        });
        Route::get('/admin/consultations', [AdminController::class, 'consultationIndex'])->name('admin.consultations.index');
        Route::get('/admin/consultation/{consultations}/monitor', [AdminController::class, 'consultationDetail'])->name('admin.consultations.detail');
        Route::prefix('admin')->group(function () {
            Route::get('/apotek/html', [AdminController::class, 'getApotekHtml']);
            Route::get('/dokter/html', [AdminController::class, 'getDokterHtml']);
            Route::get('/artikel/html', [AdminController::class, 'getArticleHtml']);
            Route::get('/konsultasi/html', [AdminController::class, 'getConsultationHtml']);
            Route::get('/applications/update-status/{id}', [AdminController::class, 'updateApplicationStatus'])->name('admin.applications.update_status');
            Route::get('/applicants/history', [AdminController::class, 'applicantHistory'])->name('admin.applicants.history');
        });
    });

    Route::prefix('chat-dokter')->group(function () {
        Route::get('/', [ChatDokterController::class, 'index'])->name('chat.index');
        Route::post('/send', [ChatDokterController::class, 'sendMessage'])->name('chat.send');
        Route::get('/messages/{chat}', [ChatDokterController::class, 'messages'])->name('chat.messages');
        Route::post('/{chat}/call/start', [ChatDokterController::class, 'start'])->name('chats.call.start');
        Route::post('/{chat}/call/end', [ChatDokterController::class, 'end'])->name('chats.call.end');
    });

    Route::prefix('address')->group(function () {
        Route::post('/', [UserController::class, 'storeAddress'])->name('address.store');
        Route::post('/set-default', [UserController::class, 'setDefaultAddress'])->name('address.set_default');
        Route::put('/{id}', [UserController::class, 'editAddress'])->name('address.update');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/history', [OrderController::class, 'history'])->name('orders.history');
        Route::get('/{code}', [OrderController::class, 'detail'])->name('orders.detail');
    });

    Route::get('/prescription/{id}/download', [ConsultationController::class, 'download'])->name('resep.download');
});
