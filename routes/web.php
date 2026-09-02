<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\JabatanController;
use App\Http\Controllers\Admin\LaporanController;
use App\Http\Controllers\Admin\PegawaiController;
use App\Http\Controllers\Admin\PenggajianController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        Route::get('/dashboard', [DashboardController::class, 'index'])
            ->name('dashboard');

        Route::resource('jabatan', JabatanController::class);
        Route::resource('pegawai', PegawaiController::class);
        Route::resource('penggajian', PenggajianController::class);

        Route::get('/pegawai/{pegawai}/gaji', [PenggajianController::class, 'getGaji'])->name('pegawai.gaji');
        Route::get('/laporan', [LaporanController::class, 'index'])->name('laporan.index');
        Route::get('/laporan/pdf', [LaporanController::class, 'pdf'])->name('laporan.pdf');

    });
        
Route::middleware((['auth', 'pegawai']))->prefix('pegawai')->group(function() {
    Route::get('/dashboard', function() {
        return view('pegawai.dashboard');
        })->name('pegawai.dashboard');
});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__.'/auth.php';
