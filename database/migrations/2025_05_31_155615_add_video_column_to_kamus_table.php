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
        Schema::table('kamus', function (Blueprint $table) {
            $table->string('video')->after('kata');
        });
    }

    public function down()
    {
        Schema::table('kamus', function (Blueprint $table) {
            $table->dropColumn('video');
        });
    }

};
