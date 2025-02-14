<?php

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SocialliteController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;


// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', function () {
    return view('dashboard.indexUser');
})->name('home');

Route::get('/admin', function () {
    return view('dashboard.index');
})->name('home');

//ROUTE LOGIN REGIS MASIH PAKE YANG INI
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::post('/register', [RegisteredUserController::class, 'store'])->middleware('guest');

Route::post('/login', [AuthenticatedSessionController::class, 'store'])
    ->middleware('guest');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->middleware('auth')->name('logout');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// LOGIN WITH GOOGLE
Route::get('/auth/google', [SocialliteController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('/auth/google/callback', [SocialliteController::class, 'handleGoogleCallback']);

Route::get('/my-profile', [ProfileController::class, 'myProfile'])->middleware('auth');


require __DIR__.'/auth.php';
