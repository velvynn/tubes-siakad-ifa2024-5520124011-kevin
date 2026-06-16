<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DosenController;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\MataKuliahController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\KrsController;

// Halaman utama redirect ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// Legacy redirect default Laravel UI ke dashboard
Route::get('/home', function () {
    return redirect()->route('dashboard');
});

// Auth routes dari Laravel UI
Auth::routes();

// Routes yang memerlukan autentikasi
Route::middleware(['auth'])->group(function () {
    
    // Dashboard (semua role bisa akses)
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // ========== ROUTES KHUSUS ADMIN ==========
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        
        // Manajemen Dosen
        Route::resource('dosen', DosenController::class);
        
        // Manajemen Mahasiswa
        Route::resource('mahasiswa', MahasiswaController::class);
        
        // Manajemen Mata Kuliah
        Route::resource('matakuliah', MataKuliahController::class);
        
        // Manajemen Jadwal
        Route::resource('jadwal', JadwalController::class);
        
        // Manajemen KRS (Admin view)
        Route::get('/krs', [KrsController::class, 'adminIndex'])->name('krs.index');
        Route::get('/krs/export/pdf', [KrsController::class, 'adminExportPdf'])->name('krs.export.pdf');
        Route::get('/krs/export/csv', [KrsController::class, 'adminExportCsv'])->name('krs.export.csv');
        Route::get('/krs/export/excel', [KrsController::class, 'adminExportExcel'])->name('krs.export.excel');
    });
    
    // ========== ROUTES KHUSUS MAHASISWA ==========
    Route::middleware(['role:mahasiswa'])->prefix('mahasiswa')->name('mahasiswa.')->group(function () {
        
        // KRS Management
        Route::get('/krs', [KrsController::class, 'index'])->name('krs.index');
        Route::get('/krs/create', [KrsController::class, 'create'])->name('krs.create');
        Route::post('/krs', [KrsController::class, 'store'])->name('krs.store');
        Route::delete('/krs/{krs}', [KrsController::class, 'destroy'])->name('krs.destroy');
        
        // Export KRS ke PDF / Excel
        Route::get('/krs/export/pdf', [KrsController::class, 'exportPdf'])->name('krs.export.pdf');
        Route::get('/krs/export/csv', [KrsController::class, 'exportCsv'])->name('krs.export.csv');
        Route::get('/krs/export/excel', [KrsController::class, 'exportExcel'])->name('krs.export.excel');
        
        // Lihat jadwal kuliah
        Route::get('/jadwal', [KrsController::class, 'jadwalSaya'])->name('jadwal.index');
    });
});