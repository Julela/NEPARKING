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
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ScanController;
use App\Http\Controllers\IzinController;

Route::get('/izin/create', [IzinController::class, 'create'])->name('izin.create');
Route::post('/izin', [IzinController::class, 'store'])->name('izin.store');

//history aktivitas user
Route::middleware(['auth'])->group(function () {
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');
});


//jadwal pelajaran
Route::get('/jadwal', [JadwalController::class, 'index'])->name('jadwal');


//parkir
Route::get('/parkir', [ParkingController::class, 'index'])->name('parkir.index');
Route::post('/parkir/register', [ParkingController::class, 'register'])->name('parkir.register');
Route::post('/parkir/check', [ParkingController::class, 'check'])->name('parkir.check');
Route::put('/parkir/{id}', [ParkingController::class, 'update'])->name('parking.update');


Route::get('/generate-qr', [QrController::class, 'generateQr'])->name('generate.qr');
Route::get('/download-latest-qr', [QRController::class, 'downloadLatestQR'])->middleware('auth');


//form hadir kendaraan
Route::get('/absen', [AbsenController::class, 'showForm'])->name('absen.form')->middleware('auth');
Route::post('/absen', [AbsenController::class, 'store'])->name('absen.store')->middleware('auth');


// Route::get('/parkir', [ParkingController::class, 'index'])->name('parkir.index');
// Route::post('/parkir/book', [ParkingController::class, 'book'])->name('parkir.book');
// Route::post('/parkir/cancel', [ParkingController::class, 'cancel'])->name('parkir.cancel');

// ROUTE ADMIN  PAGE

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/admin', function () {
        return view('dashboard.index');
    })->name('admin.page')->middleware('permission:main-admin');

    Route::get('/dataUser', [AdminController::class, 'users'])->name('admin.dataUser');
    Route::get('/dataUser/create', [AdminController::class, 'create'])->name('admin.createUser');
    Route::post('/dataUser', [AdminController::class, 'store'])->name('admin.dataUser.store');
    Route::get('/dataUser/{id}/edit', [AdminController::class, 'edit'])->name('admin.editUser');
    Route::put('/dataUser/{id}', [AdminController::class, 'update'])->name('admin.dataUser.update');
    Route::delete('/dataUser/{id}', [AdminController::class, 'destroy'])->name('admin.dataUser.destroy');


    Route::get('/admin/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/parking', [AdminController::class, 'parking'])->name('admin.parking');
    Route::delete('/parking/delete/{id}/{type}', [AdminController::class, 'destroyParking'])->name('admin.destroyParking');
    Route::get('/reports', [AdminController::class, 'reports'])->name('admin.reports');
    Route::get('/settings', [AdminController::class, 'settings'])->name('admin.settings');
    Route::get('/my-profile', [AdminController::class, 'myProfile'])->name('admin.index');
    Route::put('/my-profile/update/{id}', [AdminController::class, 'updateProfile'])->middleware('auth');


    Route::get('/qr-requests', [QrController::class, 'pendingRequests'])->name('qr-requests');
    Route::post('/qr-approve/{id}', [QrController::class, 'approveQRUpdate'])->name('qr-approve');
    Route::post('/qr-reject/{id}', [QrController::class, 'rejectQRUpdate'])->name('qr-reject');
    Route::get('/pending-requests/count', [QrController::class, 'countPendingRequests']);
    Route::get('/dataKendaraan', [AdminController::class, 'dataKendaraan'])->name('admin.dataKendaraan');
});

//Notif
Route::get('/my-notifikasi', [NotifikasiController::class, 'index'])->name('notifikasi.index');
Route::get('/notifikasi/count', [NotifikasiController::class, 'getUnreadCount']);
Route::post('/notifikasi/read', [NotifikasiController::class, 'markAsRead']);



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

Route::get('/password', [PasswordController::class, 'index'])->name('password.index');
Route::put('/password/update/{id}', [PasswordController::class, 'gantiPassword'])->name('password.update');


Route::get('/', function () {
    return view('dashboard.indexUser');
})->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/scan', [ScanController::class, 'index'])->name('history.index');
    Route::post('/scan/process', [ScanController::class, 'processQrCode'])->name('scanner.process');

});



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
