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
        Schema::table('user_access_menu', function (Blueprint $table) {
            $table->foreign('menu_id')->references('id_user_menu')->on('user_menu');
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_access_menu', function (Blueprint $table) {
            //
        });
    }
};
