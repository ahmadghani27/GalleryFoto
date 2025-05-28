<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;

// redirect agar langsung menuju ke halaman dashboard
Route::get('/', function () {
    return redirect('/login');
});


Route::get('/arsip', function () {
    return view('photo.arsip');
})->name('arsip');
Route::get('/album/kenangan', function () {
    return view('photo.photo-album');
})->name('album.kenangan');

Route::middleware('auth')->group(function () {
    //Route Album
    Route::get('/album', [AlbumController::class, 'index'])->name('album');
    Route::post('/album', [AlbumController::class, 'store'])->name('album.store');
    Route::delete('/album/{id}', [AlbumController::class, 'destroy'])->name('album.destroy');
    Route::patch('/album/{id}', [AlbumController::class, 'update'])->name('album.update');
    Route::get('/akun', [ProfileController::class, 'edit'])->name('akun');
    //Route Foto
    Route::get('/foto', [PhotoController::class, 'index'])->name('foto');
    Route::post('/foto/single-upload', [PhotoController::class, 'store'])->name('foto.singleupload');
    Route::post('/foto/multi-upload', [PhotoController::class, 'massStore'])->name('foto.multiupload');
    Route::delete('/foto/single-delete', [PhotoController::class, 'destroy'])->name('foto.singledelete');
    Route::patch('/foto/edit-judul', [PhotoController::class, 'editJudul'])->name('foto.editjudul');
    Route::patch('/foto/single-arsip', [PhotoController::class, 'arsipkan'])->name('foto.singlearsip');
    Route::patch('/foto/favorite', [PhotoController::class, 'toggleFavorite'])->name('foto.togglefavorite');
    //Route Profile
    Route::patch('/akun/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/akun/password', [PasswordController::class, 'update'])->name('update_password');
    Route::delete('/akun', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
