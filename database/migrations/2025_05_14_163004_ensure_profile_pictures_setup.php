<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Memastikan semua kolom yang diperlukan sudah ada dan benar
        if (Schema::hasTable('users')) {
            // Buat file default jika belum ada
            if (!file_exists(storage_path('app/public/profile_pictures/default.png'))) {
                // Pastikan direktori ada
                if (!file_exists(storage_path('app/public/profile_pictures'))) {
                    mkdir(storage_path('app/public/profile_pictures'), 0755, true);
                }
                
                // Copy file default.png dari public/img jika ada
                if (file_exists(public_path('img/profile-default.png'))) {
                    copy(
                        public_path('img/profile-default.png'), 
                        storage_path('app/public/profile_pictures/default.png')
                    );
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Tidak perlu rollback untuk migrasi ini
    }
};