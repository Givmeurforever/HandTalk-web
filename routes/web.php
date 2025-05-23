<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopikUserController;
use App\Http\Controllers\KamusUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\KursusController;
use App\Http\Controllers\Admin\KamusController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\LatihanController;
use App\Http\Controllers\Admin\KuisController;
use App\Http\Controllers\Admin\PengaturanController;
use App\Http\Controllers\Admin\AdminLoginController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SettingsController;

// ✨ Halaman publik
Route::get('/', fn() => view('pages.home'))->name('home');
Route::get('/tentang', [NavigationController::class, 'tentang'])->name('tentang');
Route::get('/signup', [AuthController::class, 'showForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🛡️ Rute yang butuh login
Route::middleware('auth')->group(function () {
    Route::get('/kursus', [NavigationController::class, 'kursus'])->name('kursus');
    Route::get('/kursus/{topikSlug}/{materiSlug}', [TopikUserController::class, 'show'])->name('topik.show');
    Route::get('/kamus', [KamusUserController::class, 'index'])->name('kamus');
    Route::get('/settings', [NavigationController::class, 'settings'])->name('settings');
    Route::get('/dashboard',  [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/settings', [App\Http\Controllers\SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [App\Http\Controllers\SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/account', [App\Http\Controllers\SettingsController::class, 'deleteAccount'])->name('account.delete');
});

// Admin Dashboard

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // Resource Routes dengan parameter override agar pakai "user"
    Route::resource('pengguna', PenggunaController::class)->parameters([
        'pengguna' => 'user'
    ]);

    Route::resource('kursus', KursusController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('latihan', LatihanController::class);
    Route::resource('kuis', KuisController::class);
    Route::resource('kamus', KamusController::class);

    // Custom routes khusus pengguna
    Route::patch('pengguna/{user}/status', [PenggunaController::class, 'updateStatus'])->name('pengguna.status');
    Route::get('pengguna/search', [PenggunaController::class, 'search'])->name('pengguna.search');
    Route::get('pengguna/filter', [PenggunaController::class, 'filter'])->name('pengguna.filter');
});
