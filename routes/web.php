<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BeritaController;
use App\Http\Controllers\BudayaController;
// Route::get('/', function () {
//     return view('dashboard');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/edit', function () {
    return view('admin');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('budaya', BudayaController::class);
    Route::get('/admin',[AdminController::class,'index'])->name('admin.dashboard');
});

Route::resource('berita',BeritaController::class)->middleware(['auth']);

require __DIR__.'/auth.php';
