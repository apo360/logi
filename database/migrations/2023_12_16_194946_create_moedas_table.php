<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('moedas', function (Blueprint $table) {
            $table->id();
            $table->string('codigo', 3)->unique(); // Código de moeda conforme ISO 4217
            $table->string('nome'); // Nome da moeda
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('moedas');
    }
};
