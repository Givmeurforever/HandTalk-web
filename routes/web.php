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
use App\Http\Controllers\KursusController as FrontKursusController;
use App\Http\Controllers\LatihanController as FrontLatihanController;
use App\Http\Controllers\KuisController as FrontKuisController;
use App\Http\Controllers\KamusController as FrontKamusController;
use App\Http\Controllers\Admin\AdminLoginController;
    
// ✨ Halaman Utama / Publik

Route::get('/', fn() => view('pages.home'))->name('home');
Route::get('/signup', fn() => view('pages.signup'))->name('signup');
Route::get('/login', fn() => view('pages.login'))->name('login');
Route::get('/kursus', fn() => view('pages.kursus'))->name('kursus');
Route::get('/kursus/{topikSlug}/{materiSlug}', [TopikUserController::class, 'show'])->name('topik.show');
Route::get('/kamus', [KamusUserController::class, 'index'])->name('kamus');
Route::get('/settings', fn() => view('pages.settings'))->name('settings');
Route::get('/tentang', fn() => view('pages.tentang'))->name('tentang');


// Admin Dashboard

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD Resources
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('kursus', KursusController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('latihan', LatihanController::class);
    Route::resource('kuis', KuisController::class);
    Route::resource('kamus', KamusController::class);

    // pengguna
    Route::get('pengguna', [App\Http\Controllers\Admin\PenggunaController::class, 'index'])->name('pengguna.index');
    Route::post('pengguna', [App\Http\Controllers\Admin\PenggunaController::class, 'store'])->name('pengguna.store');
    Route::put('pengguna/{id}', [App\Http\Controllers\Admin\PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('pengguna/{id}', [App\Http\Controllers\Admin\PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    Route::patch('pengguna/{id}/status', [App\Http\Controllers\Admin\PenggunaController::class, 'updateStatus'])->name('pengguna.status');

    // kuis
    Route::get('kuis', [App\Http\Controllers\Admin\KuisController::class, 'index'])->name('kuis.index');
    Route::get('kuis/create', [App\Http\Controllers\Admin\KuisController::class, 'create'])->name('kuis.create');
    Route::post('kuis', [App\Http\Controllers\Admin\KuisController::class, 'store'])->name('kuis.store');
    Route::get('kuis/{kuis}', [App\Http\Controllers\Admin\KuisController::class, 'show'])->name('kuis.show');
    Route::get('kuis/{kuis}/edit', [App\Http\Controllers\Admin\KuisController::class, 'edit'])->name('kuis.edit');
    Route::put('kuis/{kuis}', [App\Http\Controllers\Admin\KuisController::class, 'update'])->name('kuis.update');
    Route::delete('kuis/{kuis}', [App\Http\Controllers\Admin\KuisController::class, 'destroy'])->name('kuis.destroy');

    // Pengaturan (jika hanya 1 halaman)
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');

    // Logout (jika manual)
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::get('/profile', fn() => view('admin.profile'))->name('profile');
    Route::get('/notifications', fn() => view('admin.notifications'))->name('notifications');
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');



});
