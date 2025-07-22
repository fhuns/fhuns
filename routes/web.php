<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\KeuanganController;

Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Mahasiswa Routes
    Route::prefix('mahasiswa')->group(function () {
        Route::get('/', [MahasiswaController::class, 'index'])->name('mahasiswa.index');
        Route::get('/create', [MahasiswaController::class, 'create'])->name('mahasiswa.create');
        Route::post('/', [MahasiswaController::class, 'store'])->name('mahasiswa.store');
        Route::get('/{mahasiswa}/edit', [MahasiswaController::class, 'edit'])->name('mahasiswa.edit');
        Route::put('/{mahasiswa}', [MahasiswaController::class, 'update'])->name('mahasiswa.update');
        Route::delete('/{mahasiswa}', [MahasiswaController::class, 'destroy'])->name('mahasiswa.destroy');
    })->middleware('can:admin-access');

    // Dosen Routes
    Route::prefix('dosen')->group(function () {
        Route::get('/', [DosenController::class, 'index'])->name('dosen.index');
        Route::get('/create', [DosenController::class, 'create'])->name('dosen.create');
        Route::post('/', [DosenController::class, 'store'])->name('dosen.store');
        Route::get('/{dosen}/edit', [DosenController::class, 'edit'])->name('dosen.edit');
        Route::put('/{dosen}', [DosenController::class, 'update'])->name('dosen.update');
        Route::delete('/{dosen}', [DosenController::class, 'destroy'])->name('dosen.destroy');
    })->middleware('can:admin-access');

    // Keuangan Routes
    Route::prefix('keuangan')->group(function () {
        Route::get('/', [KeuanganController::class, 'index'])->name('keuangan.index');
        Route::get('/create', [KeuanganController::class, 'create'])->name('keuangan.create');
        Route::post('/', [KeuanganController::class, 'store'])->name('keuangan.store');
        Route::get('/{keuangan}/edit', [KeuanganController::class, 'edit'])->name('keuangan.edit');
        Route::put('/{keuangan}', [KeuanganController::class, 'update'])->name('keuangan.update');
        Route::delete('/{keuangan}', [KeuanganController::class, 'destroy'])->name('keuangan.destroy');
    })->middleware('can:admin-access');
});

require __DIR__.'/auth.php';