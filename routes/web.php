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
});




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
    Route::get('pengguna', [PenggunaController::class, 'index'])->name('pengguna.index');
    Route::get('pengguna/create', [PenggunaController::class, 'create'])->name('pengguna.create');
    Route::post('pengguna', [PenggunaController::class, 'store'])->name('pengguna.store');
    Route::get('pengguna/{id}/edit', [PenggunaController::class, 'edit'])->name('pengguna.edit');
    Route::put('pengguna/{id}', [PenggunaController::class, 'update'])->name('pengguna.update');
    Route::delete('pengguna/{id}', [PenggunaController::class, 'destroy'])->name('pengguna.destroy');
    Route::patch('pengguna/{id}/status', [PenggunaController::class, 'updateStatus'])->name('pengguna.status');



    // Materi
    Route::get('/materi', [MateriController::class, 'index'])->name('materi.index');
    Route::get('/materi/create', [MateriController::class, 'create'])->name('materi.create');
    Route::post('/materi', [MateriController::class, 'store'])->name('materi.store');
    Route::get('/materi/{id}', [MateriController::class, 'show'])->name('materi.show');
    Route::get('/materi/{id}/edit', [MateriController::class, 'edit'])->name('materi.edit');
    Route::put('/materi/{id}', [MateriController::class, 'update'])->name('materi.update');
    Route::delete('/materi/{id}', [MateriController::class, 'destroy'])->name('materi.destroy');
    
    // Latihan
    Route::get('/latihan', [LatihanController::class, 'index'])->name('latihan.index');
    Route::get('/latihan/create', [LatihanController::class, 'create'])->name('latihan.create');
    Route::post('/latihan', [LatihanController::class, 'store'])->name('latihan.store');
    Route::get('/latihan/show/{id}', [LatihanController::class, 'show'])->name('latihan.show');
    Route::get('/latihan/edit/{id}', [LatihanController::class, 'edit'])->name('latihan.edit');
    Route::put('/latihan/edit/{id}', [LatihanController::class, 'update'])->name('latihan.update');
    Route::delete('/latihan/delete/{id}', [LatihanController::class, 'destroy'])->name('latihan.delete');
    
    // kuis
    // Route::get('kuis', [App\Http\Controllers\Admin\KuisController::class, 'index'])->name('kuis.index');
    // Route::get('kuis/create', [App\Http\Controllers\Admin\KuisController::class, 'create'])->name('kuis.create');
    // Route::post('kuis', [App\Http\Controllers\Admin\KuisController::class, 'store'])->name('kuis.store');
    // Route::get('kuis/{kuis}', [App\Http\Controllers\Admin\KuisController::class, 'show'])->name('kuis.show');
    // Route::get('kuis/{kuis}/edit', [App\Http\Controllers\Admin\KuisController::class, 'edit'])->name('kuis.edit');
    // Route::put('kuis/{kuis}', [App\Http\Controllers\Admin\KuisController::class, 'update'])->name('kuis.update');
    // Route::delete('kuis/{kuis}', [App\Http\Controllers\Admin\KuisController::class, 'destroy'])->name('kuis.destroy');
    Route::get('/kuis', [KuisController::class, 'index'])->name('kuis.index');
    Route::get('/kuis/create', [KuisController::class, 'create'])->name('kuis.create');
    Route::post('/kuis', [KuisController::class, 'store'])->name('kuis.store');
    Route::get('/kuis/{id}/edit', [KuisController::class, 'edit'])->name('kuis.edit');

    // Pengaturan (jika hanya 1 halaman)
    Route::get('/pengaturan', [PengaturanController::class, 'index'])->name('pengaturan.index');

    // Logout (jika manual)
    Route::post('/logout', [DashboardController::class, 'logout'])->name('logout');
    Route::get('/profile', fn() => view('admin.profile'))->name('profile');
    Route::get('/notifications', fn() => view('admin.notifications'))->name('notifications');
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');



});
