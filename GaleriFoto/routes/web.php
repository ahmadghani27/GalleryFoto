<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
// redirect agar langsung menuju ke halaman dashboard
Route::get('/photo', function () {
    return view('photo.index');
});

Route::get('/foto', function () {
    return view('photo.photo');
})->middleware(['auth', 'verified'])->name('foto');


Route::middleware('auth')->group(function () {
    Route::get('/akun', [ProfileController::class, 'edit'])->name('akun');
    Route::patch('/akun/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/akun/password', [PasswordController::class, 'update'])->name('update_password');
    Route::delete('/akun', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
