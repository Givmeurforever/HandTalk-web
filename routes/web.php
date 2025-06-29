<?php

use App\Http\Controllers\Admin\AdminLoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TopikUserController;
use App\Http\Controllers\KamusUserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PenggunaController;
use App\Http\Controllers\Admin\TopikController;
use App\Http\Controllers\Admin\MateriController;
use App\Http\Controllers\Admin\LatihanController;
use App\Http\Controllers\Admin\KuisController;
use App\Http\Controllers\Admin\KamusController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NavigationController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\SettingsController;
use Illuminate\Support\Facades\DB;

// ✨ Halaman Publik
Route::get('/', fn () => view('pages.home'))->name('home');
Route::get('/tentang', [NavigationController::class, 'about'])->name('about');
Route::get('/signup', [AuthController::class, 'showForm'])->name('signup');
Route::post('/signup', [AuthController::class, 'register']);
Route::get('/login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// 🛡️ Rute User Login
Route::middleware('auth')->group(function () {

    // 🏠 Dashboard User
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // 📚 Kursus (Topik & Materi)
    Route::get('/kursus', [TopikUserController::class, 'index'])->name('kursus');

    // 🧠 Kuis (New Structure: semua soal sekaligus)
    Route::get('/kursus/{topikSlug}/kuis', [TopikUserController::class, 'kuis'])->name('kursus.kuis');
    Route::post('/kursus/{topikSlug}/kuis/submit', [TopikUserController::class, 'submitKuis'])->name('kursus.kuis.submit');
    Route::get('/kursus/{topikSlug}/kuis/hasil', [TopikUserController::class, 'hasilKuis'])->name('kursus.kuis.hasil');

    // 📖 Tampilkan Materi (show page)
    Route::get('/kursus/{topikSlug}/{materiSlug}', [TopikUserController::class, 'show'])->name('kursus.show');
    Route::post('/kursus/{topikSlug}/{materiSlug}/complete', [TopikUserController::class, 'completeMateri'])
    ->name('materi.complete');

    // 📝 Latihan (New Structure: multiple questions per page)
    Route::get('/kursus/{topikSlug}/{materiSlug}/latihan/{page?}', [TopikUserController::class, 'latihan'])
        ->name('kursus.latihan')
        ->where('page', '[0-9]+');

    Route::post('/kursus/{topikSlug}/{materiSlug}/latihan/submit', [TopikUserController::class, 'submitLatihan'])
        ->name('kursus.latihan.submit');

    Route::get('/kursus/{topikSlug}/{materiSlug}/latihan/{page}/hasil', [TopikUserController::class, 'hasilLatihan'])
        ->name('kursus.latihan.hasil')
        ->where('page', '[0-9]+');

    // 🔁 Latihan (Old: satu soal per halaman) — untuk kompatibilitas
    Route::get('/topik/{topik_slug}/materi/{materi_slug}/latihan/{urutan}', [TopikUserController::class, 'latihan'])
        ->name('latihan.index');
    Route::post('/latihan/check', [TopikUserController::class, 'checkLatihan'])->name('latihan.check');
    // 🔁 Kuis (Old: per soal) — untuk kompatibilitas
    Route::get('/topik/{topik_slug}/kuis/{urutan}', [TopikUserController::class, 'kuisOld'])->name('kuis.index');
    // 📘 Kamus
    Route::get('/kamus', [KamusUserController::class, 'index'])->name('kamus');
    // ⚙️ Settings
    Route::get('/settings', [SettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');
    Route::delete('/account', [SettingsController::class, 'deleteAccount'])->name('account.delete');
});

Route::redirect('/admin', '/admin/login');
Route::redirect('/admin/', '/admin/login');

// 🛠️ Admin Dashboard
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('', function () {
        return redirect()->route('admin.login');
    });
    
    // Autentikasi admin
    Route::get('login', [AdminLoginController::class, 'showLoginForm'])->name('login');
    Route::post('login', [AdminLoginController::class, 'login'])->name('login.submit');
    Route::post('logout', [AdminLoginController::class, 'logout'])->name('logout');

    // Proteksi semua route admin
    Route::middleware('auth:admin')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('pengguna', PenggunaController::class)->parameters(['pengguna' => 'user']);
        Route::patch('pengguna/{user}/status', [PenggunaController::class, 'updateStatus'])->name('pengguna.status');
        Route::get('pengguna/search', [PenggunaController::class, 'search'])->name('pengguna.search');
        Route::get('pengguna/filter', [PenggunaController::class, 'filter'])->name('pengguna.filter');

        Route::resource('topik', TopikController::class);
        Route::resource('materi', MateriController::class);
        Route::resource('latihan', LatihanController::class);
        Route::get('latihan/materi-by-topik/{topik_id}', [LatihanController::class, 'getMateriByTopik'])->name('latihan.materi-by-topik');
        Route::resource('kuis', KuisController::class);
        Route::resource('kamus', KamusController::class)->parameters(['kamus' => 'kamus']);
    });
});


// CHECK DATABASE STRUCTURE
Route::get('/struktur-db', function () {
    $tables = DB::select('SHOW TABLES');
    $databaseName = DB::getDatabaseName();
    $output = [];

    foreach ($tables as $tableObj) {
        $table = array_values((array) $tableObj)[0];
        $columns = DB::table('information_schema.columns')
            ->select('column_name', 'data_type')
            ->where('table_schema', $databaseName)
            ->where('table_name', $table)
            ->get();

        $output[$table] = $columns;
    }

    echo "<pre>";
    foreach ($output as $table => $columns) {
        echo "TABEL: $table\n";
        foreach ($columns as $col) {
            echo "- {$col->column_name} ({$col->data_type})\n";
        }
        echo "\n";
    }
    echo "</pre>";
});
Route::get('/debug-kuis/{topikSlug}', function($topikSlug) {
    dd('Route reached with slug: ' . $topikSlug);
})->name('debug.kuis');