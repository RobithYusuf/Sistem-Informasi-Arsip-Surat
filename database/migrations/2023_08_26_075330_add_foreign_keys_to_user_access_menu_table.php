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
            $table->foreign('menu_id')
                  ->references('id_user_menu')
                  ->on('user_menu')
                  ->name('user_access_menu_menu_id_foreign'); // Ganti nama constraint
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('user_access_menu', function (Blueprint $table) {
            $table->dropForeign('user_access_menu_menu_id_foreign'); // Hapus constraint
        });
    }
};
