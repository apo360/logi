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
        Schema::create('liquidacao', function (Blueprint $table) {
            $table->id();
            $table->integer('ProcessoID');
            $table->decimal('Direitos', 10, 2);
            $table->decimal('MultasDiversas', 10, 2);
            $table->decimal('Iva', 10, 2);
            $table->decimal('Iec', 10, 2);
            $table->decimal('EmolumentosPessoais', 10, 2);
            $table->decimal('ImpostoEstatistico', 10, 2);
            $table->decimal('Armazem', 10, 2);
            $table->decimal('ReceitasDAR', 10, 2);
            $table->decimal('SUBTOTAL', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('liquidacao');
    }
};
