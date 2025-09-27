<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BudayaController;
use App\Http\Controllers\GalleryController;
// Route::get('/', function () {
//     return view('dashboard');
// });


// Routes Dashboard
Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/welcome', function () {
    return view('welcome');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes Budaya
Route::resource('budaya', BudayaController::class);

//Routes Berita
Route::resource('berita',BeritaController::class)->middleware(['auth']);

//Routes Admin Beranda
Route::get('/edit', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('dashboard');

//Routes Profil
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/admin',[AdminController::class,'index'])->name('admin.dashboard');
});

// Routes Galeri
Route::middleware('auth')->group(function () {
    Route::get('/galeri', [GalleryController::class, 'index'])->name('galeri.index');
    Route::get('/galeri/upload', [GalleryController::class, 'create'])->name('galeri.create');
    Route::post('/galeri', [GalleryController::class, 'store'])->name('galeri.store');
    Route::delete('/galeri/{gallery}', [GalleryController::class, 'destroy'])->name('galeri.destroy');
});
require __DIR__.'/auth.php';
