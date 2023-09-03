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
        Schema::create('submenu', function (Blueprint $table) {
            $table->id('id_submenu');
            $table->unsignedBigInteger('menu_id');
            $table->string('nama_submenu', 10);
            $table->string('url', 50);
            $table->string('icon', 25);
            $table->integer('is_active')->default(1);
            $table->timestamps();

            // Foreign key
            $table->foreign('menu_id')->references('id_user_menu')->on('user_menu');
        });
    }



    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('submenu');
    }
};
