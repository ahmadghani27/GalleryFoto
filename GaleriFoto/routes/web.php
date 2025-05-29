<?php

use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AlbumController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ArchiveController;

// redirect agar langsung menuju ke halaman dashboard
Route::get('/', function () {
    return redirect('/login');
});


Route::middleware('auth')->group(function () {
    //Route Album
    Route::get('/album', [AlbumController::class, 'index'])->name('album');
    Route::post('/album', [AlbumController::class, 'store'])->name('album.store');
    Route::delete('/album/{id_album}', [AlbumController::class, 'destroy'])->name('album.destroy');
    Route::get('/album/{folder}', [AlbumController::class, 'show'])->name('album.show');
    Route::patch('/album/{id_album}', [AlbumController::class, 'update'])->name('album.update');
    //Route Foto
    Route::get('/foto', [PhotoController::class, 'index'])->name('foto');
    Route::post('/foto/single-upload', [PhotoController::class, 'store'])->name('foto.singleupload');
    Route::post('/foto/multi-upload', [PhotoController::class, 'massStore'])->name('foto.multiupload');
    Route::delete('/foto/single-delete', [PhotoController::class, 'destroy'])->name('foto.singledelete');
    Route::patch('/foto/edit-judul', [PhotoController::class, 'editJudul'])->name('foto.editjudul');
    Route::patch('/foto/single-arsip', [PhotoController::class, 'arsipkan'])->name('foto.singlearsip');
    Route::patch('/foto/single-pindahalbum', [PhotoController::class, 'pindahAlbum'])->name('foto.singlepindahalbum');
    Route::patch('/foto/favorite', [PhotoController::class, 'toggleFavorite'])->name('foto.togglefavorite');
    Route::get('/api/getActiveAlbum/{id}', [AlbumController::class, 'getActiveAlbum'])->name('api.getActiveAlbum');
    Route::get('/foto_access/{path}', [PhotoController::class, 'access'])
        ->where('path', '.*')
        ->name('foto.access');
    Route::post('/foto/unarchive', [PhotoController::class, 'unarsipkan'])
        ->name('photos.unarchive');
    //Route Profile
    Route::get('/akun', [ProfileController::class, 'edit'])->name('akun');
    Route::patch('/akun/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::patch('/akun/password', [PasswordController::class, 'update'])->name('update_password');
    Route::delete('/akun', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/arsip', [ArchiveController::class, 'show'])->name('arsip');
    Route::post('/arsip/verify', [ArchiveController::class, 'verify'])->name('arsip.verify');
    Route::get('/arsip/content', [ArchiveController::class, 'content'])->name('arsip.content');
});

require __DIR__ . '/auth.php';
