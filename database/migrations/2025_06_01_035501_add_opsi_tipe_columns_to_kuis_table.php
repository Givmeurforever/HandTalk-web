<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('kuis', function (Blueprint $table) {
            $table->enum('opsi_a_tipe', ['text', 'media'])->default('text')->after('opsi_a');
            $table->enum('opsi_b_tipe', ['text', 'media'])->default('text')->after('opsi_b');
            $table->enum('opsi_c_tipe', ['text', 'media'])->default('text')->after('opsi_c');
            $table->enum('opsi_d_tipe', ['text', 'media'])->default('text')->after('opsi_d');
        });
    }

    public function down()
    {
        Schema::table('kuis', function (Blueprint $table) {
            $table->dropColumn(['opsi_a_tipe', 'opsi_b_tipe', 'opsi_c_tipe', 'opsi_d_tipe']);
        });
    }

};
