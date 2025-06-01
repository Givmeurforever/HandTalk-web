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
        Schema::create('latihan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('materi_id')->constrained('materi')->onDelete('cascade');
            $table->unsignedInteger('urutan')->default(1);

            $table->string('soal');

            $table->foreignId('opsi_a_kamus_id')->nullable()->constrained('kamus')->nullOnDelete();
            $table->foreignId('opsi_b_kamus_id')->nullable()->constrained('kamus')->nullOnDelete();
            $table->foreignId('opsi_c_kamus_id')->nullable()->constrained('kamus')->nullOnDelete();
            $table->foreignId('opsi_d_kamus_id')->nullable()->constrained('kamus')->nullOnDelete();

            $table->enum('jawaban_benar', ['A', 'B', 'C', 'D']);
            $table->timestamps();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('latihan');
    }
};
