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
        Schema::table('arsip', function (Blueprint $table) {
            $table->foreign('users_id')->references('id')->on('users');
            $table->foreign('klasifikasi_id')->references('id_klasifikasi_arsip')->on('klasifikasi_arsip');
            $table->foreign('lemari_id')->references('id_lemari')->on('lemari');
            $table->foreign('rak_id')->references('id_rak')->on('rak');
            $table->foreign('folder_id')->references('id_folder')->on('folder');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('arsip', function (Blueprint $table) {
            //
        });
    }
};
