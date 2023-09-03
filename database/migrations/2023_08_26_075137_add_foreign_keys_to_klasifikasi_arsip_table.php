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
        Schema::table('klasifikasi_arsip', function (Blueprint $table) {
            $table->foreign('daftar_arsip_id')->references('id_daftar_arsip')->on('daftar_arsip');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('klasifikasi_arsip', function (Blueprint $table) {
            //
        });
    }
};
