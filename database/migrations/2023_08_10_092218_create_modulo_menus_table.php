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
        Schema::create('modulo_menus', function (Blueprint $table) {
            $table->unsignedBigInteger('modulo_id');
            $table->unsignedBigInteger('menu_id');
            $table->primary(['modulo_id', 'menu_id']);
            $table->foreign('modulo_id')->references('id')->on('modulos');
            $table->foreign('menu_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('modulo_menus');
    }
};
