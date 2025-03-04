<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SocialliteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\KendaraanController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\PasswordController;
use App\Http\Controllers\CutiController;
use App\Http\Controllers\NotifikasiController;
use App\Http\Controllers\ParkingController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\AbsenController;

//jadwal pelajaran
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');


//parkir
Route::get('/parkir', [ParkingController::class, 'index'])->name('parkir.index');
Route::post('/parkir/register', [ParkingController::class, 'register'])->name('parkir.register');
Route::post('/parkir/check', [ParkingController::class, 'check'])->name('parkir.check');

//form hadir kendaraan
Route::get('/generate-qr', [QrController::class, 'generateQr'])->name('generate.qr');
Route::get('/absen', [AbsenController::class, 'showForm'])->name('absen.form');
Route::post('/absen', [AbsenController::class, 'store'])->name('absen.store');


// Route::get('/parkir', [ParkingController::class, 'index'])->name('parkir.index');
// Route::post('/parkir/book', [ParkingController::class, 'book'])->name('parkir.book');
// Route::post('/parkir/cancel', [ParkingController::class, 'cancel'])->name('parkir.cancel');

// ROUTE ADMIN  PAGE

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/admin', function () {
        return view('dashboard.index');
    })->name('admin.page')->middleware('permission:main-admin');

    
    Route::get('/my-profile', [AdminController::class, 'myProfile'])->name('kendaraan.index');

    Route::get('/qr-requests', [QrController::class, 'pendingRequests'])->name('qr-requests');
    Route::post('/qr-approve/{id}', [QrController::class, 'approveQRUpdate'])->name('qr-approve');
    Route::post('/qr-reject/{id}', [QrController::class, 'rejectQRUpdate'])->name('qr-reject');
    Route::get('/dataKendaraan', [AdminController::class, 'dataKendaraan'])->name('admin.dataKendaraan');
});

//Notif
Route::get('/my-notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');

//Izin/Sakit
Route::middleware(['auth'])->group(function () {
    Route::get('/cuti', [CutiController::class, 'index'])->name('cuti.index'); // Tampilkan form izin
    Route::post('/cuti', [CutiController::class, 'store'])->name('cuti.store'); // Simpan izin ke database
});



//Data kendaraan
Route::middleware(['auth'])->group(function () {
    Route::get('/kendaraan', [KendaraanController::class, 'index'])->name('kendaraan.index');
    Route::get('/kendaraan/create', [KendaraanController::class, 'create'])->name('kendaraan.create');
    Route::post('/kendaraan', [KendaraanController::class, 'store'])->name('kendaraan.store');
    Route::get('/kendaraan/{id}/edit', [KendaraanController::class, 'edit'])->name('kendaraan.edit');
    Route::put('/kendaraan/{id}', [KendaraanController::class, 'update'])->name('kendaraan.update');
    Route::delete('/kendaraan/{id}', [KendaraanController::class, 'destroy'])->name('kendaraan.destroy');
});

Route::get('/qr', [QrController::class, 'index'])->name('qr.index');

Route::post('/request-qr-update', [QrController::class, 'requestQRUpdate'])->name('qr.request-update');

Route::get('/admin/qr-requests', [QrController::class, 'pendingRequests'])->name('admin.qr-requests');
Route::post('/admin/qr-approve/{id}', [QrController::class, 'approveQRUpdate'])->name('admin.qr-approve');
Route::post('/admin/qr-reject/{id}', [QrController::class, 'rejectQRUpdate'])->name('admin.qr-reject');


Route::get('/password', [PasswordController::class, 'index'])->name('password.index');
Route::put('/password/update/{id}', [PasswordController::class, 'gantiPassword'])->name('password.update');


Route::get('/', function () {
    return view('dashboard.indexUser');
})->name('home');


Route::get('/scan', function () {
    return view('scan.scan');
})->name('kamera');



Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile/{id}', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'store'])->name('profile.store');
});

// LOGIN WITH GOOGLE
Route::get('/auth/google', [SocialliteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialliteController::class, 'handleGoogleCallback']);

Route::get('/my-profile', [ProfileController::class, 'myProfile'])->middleware('auth');




require __DIR__ . '/auth.php';
