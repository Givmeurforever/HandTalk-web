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
        Schema::create('materi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('topik_id')->constrained('topik')->onDelete('cascade');
            $table->string('judul');
            $table->string('slug')->unique();
            $table->string('video')->nullable(); // YouTube ID atau file path
            $table->text('deskripsi')->nullable();
            $table->integer('urutan')->default(1);
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('materi');
    }
};
