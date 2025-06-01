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
            $table->foreignId('topik_id')->constrained()->onDelete('cascade'); // relasi ke tabel topik
            $table->integer('urutan')->unsigned()->default(1);                 // urutan soal
            $table->string('soal');                                            // soal berupa teks

            // Opsi jawaban (media dari kamus atau bisa NULL jika pakai teks alternatif)
            $table->foreignId('opsi_a_kamus_id')->nullable()->constrained('kamus')->nullOnDelete();
            $table->foreignId('opsi_b_kamus_id')->nullable()->constrained('kamus')->nullOnDelete();
            $table->foreignId('opsi_c_kamus_id')->nullable()->constrained('kamus')->nullOnDelete();
            $table->foreignId('opsi_d_kamus_id')->nullable()->constrained('kamus')->nullOnDelete();

            $table->enum('jawaban_benar', ['A', 'B', 'C', 'D']);               // pilihan benar
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
