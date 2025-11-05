<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Admin\BeasiswaController as AdminBeasiswaController;
use App\Http\Controllers\Admin\PrestasiController as AdminPrestasiController;
use App\Http\Controllers\Admin\UkmController as AdminUkmController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;
use App\Http\Controllers\User\BeasiswaController as UserBeasiswaController;
use App\Http\Controllers\User\PrestasiController as UserPrestasiController;
use App\Http\Controllers\User\UkmController as UserUkmController;

// Redirect root to login
Route::get('/', function () {
    return redirect()->route('login');
});

// Auth Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
    
    // Beasiswa
    Route::get('/beasiswa', [AdminBeasiswaController::class, 'index'])->name('beasiswa.index');
    Route::post('/beasiswa/upload', [AdminBeasiswaController::class, 'upload'])->name('beasiswa.upload');
    Route::get('/beasiswa/download-pdf', [AdminBeasiswaController::class, 'downloadPdf'])->name('beasiswa.download-pdf');
    Route::put('/beasiswa/{id}', [AdminBeasiswaController::class, 'update'])->name('beasiswa.update');
    Route::delete('/beasiswa/{id}', [AdminBeasiswaController::class, 'destroy'])->name('beasiswa.destroy');
    
    // Prestasi
    Route::get('/prestasi', [AdminPrestasiController::class, 'index'])->name('prestasi.index');
    Route::post('/prestasi/upload', [AdminPrestasiController::class, 'upload'])->name('prestasi.upload');
    Route::get('/prestasi/download-pdf', [AdminPrestasiController::class, 'downloadPdf'])->name('prestasi.download-pdf');
    Route::put('/prestasi/{id}', [AdminPrestasiController::class, 'update'])->name('prestasi.update');
    Route::delete('/prestasi/{id}', [AdminPrestasiController::class, 'destroy'])->name('prestasi.destroy');
    
    // UKM
    Route::get('/ukm', [AdminUkmController::class, 'index'])->name('ukm.index');
    Route::post('/ukm/upload', [AdminUkmController::class, 'upload'])->name('ukm.upload');
    Route::get('/ukm/download-pdf', [AdminUkmController::class, 'downloadPdf'])->name('ukm.download-pdf');
    Route::put('/ukm/{id}', [AdminUkmController::class, 'update'])->name('ukm.update');
    Route::delete('/ukm/{id}', [AdminUkmController::class, 'destroy'])->name('ukm.destroy');
});

// User Routes - PERHATIKAN INI! Pakai Controller User, bukan Admin
Route::middleware(['auth', 'user'])->prefix('user')->name('user.')->group(function () {
    // Dashboard - GANTI ke UserDashboardController
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    
    // Beasiswa - GANTI ke UserBeasiswaController
    Route::get('/beasiswa', [UserBeasiswaController::class, 'index'])->name('beasiswa.index');
    Route::get('/beasiswa/download-pdf', [UserBeasiswaController::class, 'downloadPdf'])->name('beasiswa.download-pdf');
    
    // Prestasi - GANTI ke UserPrestasiController
    Route::get('/prestasi', [UserPrestasiController::class, 'index'])->name('prestasi.index');
    Route::get('/prestasi/download-pdf', [UserPrestasiController::class, 'downloadPdf'])->name('prestasi.download-pdf');
    
    // UKM - GANTI ke UserUkmController
    Route::get('/ukm', [UserUkmController::class, 'index'])->name('ukm.index');
    Route::get('/ukm/download-pdf', [UserUkmController::class, 'downloadPdf'])->name('ukm.download-pdf');
});