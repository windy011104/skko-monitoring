<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SkkoTerbit2026Controller;
use App\Http\Controllers\ProgresKontrakController;
use App\Http\Controllers\PrkLkaoController;
use App\Http\Controllers\MonPerSkkoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AlertController;
use App\Http\Controllers\BidangController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Redirect root ke login atau dashboard
Route::get('/', function () {
    if (auth()->check()) {
        return redirect()->route('dashboard');
    }

    return redirect()->route('login');
});

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
});

Route::post('/logout', [AuthController::class, 'logout'])->name('logout')->middleware('auth');

// Protected Routes - Semua user terautentikasi
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('users', UserController::class)
    ->except(['show']);
    Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');
    Route::get('/monitoring', [MonPerSkkoController::class, 'index'])
    ->name('monitoring.index');
    Route::get('/monitoring/detail/{id}', [MonPerSkkoController::class, 'show'])
    ->name('monitoring.show');
    Route::get('/alerts', [AlertController::class, 'index'])->name('alerts.index');
    Route::resource('bidang', BidangController::class)
    ->except(['show']);
    
    // Import Excel
    Route::post('/skko/import', [SkkoTerbit2026Controller::class, 'import'])
        ->name('skko.import');
    Route::post('/progres-kontrak/import', [ProgresKontrakController::class, 'import'])
    ->name('progres-kontrak.import');
    Route::post('/prk/import', [PrkLkaoController::class, 'import'])
    ->name('prk.import');
    Route::resource('skko', SkkoTerbit2026Controller::class);
    Route::resource('progres-kontrak', ProgresKontrakController::class);
    Route::resource('prk', PrkLkaoController::class);
});
