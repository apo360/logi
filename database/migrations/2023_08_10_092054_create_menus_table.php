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
        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('parent_id')->nullable();
            $table->string('title', 255);
            $table->string('slug', 255);
            $table->integer('ordem');
            $table->string('rota', 255)->nullable();
            $table->string('icone', 255);
            $table->unsignedBigInteger('modulo_id');
            $table->tinyInteger('activo')->default(1);
            $table->timestamps();
            $table->foreign('parent_id')->references('id')->on('menus');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('menus');
    }
};
