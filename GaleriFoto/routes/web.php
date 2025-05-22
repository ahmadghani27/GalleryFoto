<?php

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
    return view('menu.photo');
})->middleware(['auth', 'verified'])->name('foto');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
