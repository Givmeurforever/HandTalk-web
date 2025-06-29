<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('user_progress', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->enum('content_type', ['materi', 'kuis', 'latihan']);
            $table->bigInteger('content_id');
            $table->boolean('completed')->default(false);
            $table->integer('score')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            // Hapus unique constraint supaya bisa simpan multi entry untuk kuis
            // $table->unique(['user_id', 'content_type', 'content_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('user_progress');
    }
};