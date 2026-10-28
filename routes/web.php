<?php

use App\Http\Controllers\LaporanController;
use App\Http\Controllers\PelaporanController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [PelaporanController::class, 'create'])->name('lapor.create');
Route::post('/lapor', [PelaporanController::class, 'store'])->name('lapor.store');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('laporan', LaporanController::class)->except(['create', 'store']);
});

require __DIR__.'/auth.php';