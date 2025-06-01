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
        Schema::create('kuis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topik_id')->constrained('topik')->onDelete('cascade');

            $table->string('soal');
            $table->enum('tipe', ['pilihan_ganda', 'isian'])->default('pilihan_ganda');
            
            $table->string('opsi_a')->nullable(); // hanya digunakan jika pilihan ganda
            $table->string('opsi_b')->nullable();
            $table->string('opsi_c')->nullable();
            $table->string('opsi_d')->nullable();
            
            $table->string('jawaban_benar'); // bisa huruf (A/B/C/D) atau teks

            $table->integer('urutan')->default(1);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kuis');
    }
};
