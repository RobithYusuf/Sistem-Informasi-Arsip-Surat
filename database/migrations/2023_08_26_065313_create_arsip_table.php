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
        Schema::create('arsip', function (Blueprint $table) {
            $table->id('id_arsip');
            $table->string('nomor_berkas', 50);
            $table->string('uraian_berkas', 50);
            $table->integer('jumlah');
            $table->enum('keamanan_arsip', ['asli', 'tidak asli']);
            $table->string('uraian_arsip', 25);
            $table->binary('gambar');
            $table->string('keterangan', 25);
            $table->date('tanggal');
            $table->unsignedBigInteger('users_id');
            $table->unsignedBigInteger('klasifikasi_id');
            $table->unsignedBigInteger('lemari_id');
            $table->unsignedBigInteger('rak_id');
            $table->unsignedBigInteger('folder_id');
            $table->timestamps();

           
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('arsip');
    }
};
