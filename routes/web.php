<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopikController;
use App\Http\Controllers\KamusController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\KursusController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\LatihanController;
use App\Http\Controllers\Admin\KuisController;
use App\Http\Controllers\Admin\PengaturanController;

// Halaman Utama
Route::get('/', fn() => view('pages.home'))->name('home');

// Auth
Route::get('/signup', fn() => view('pages.signup'))->name('signup'); 
Route::get('/login', fn() => view('pages.login'))->name('login');

// Kursus
Route::get('/kursus', fn() => view('pages.kursus'))->name('kursus');

// Topik dan Materi (pakai Controller)
Route::get('/kursus/{topikSlug}/{materiSlug}', [TopikController::class, 'show'])->name('topik.show');

// Kamus
Route::get('/kamus', [KamusController::class, 'index'])->name('kamus');

// Halaman Lain
Route::get('/settings', fn() => view('pages.settings'))->name('settings');
Route::get('/tentang', fn() => view('pages.tentang'))->name('tentang');

// Dashboard Admin
Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    // CRUD resource routes
    Route::resource('pengguna', PenggunaController::class);
    Route::resource('kursus', KursusController::class);
    Route::resource('materi', MateriController::class);
    Route::resource('latihan', LatihanController::class);
    Route::resource('kuis', KuisController::class);
    Route::resource('kamus', KamusController::class); // jika pakai Admin\KamusController
});