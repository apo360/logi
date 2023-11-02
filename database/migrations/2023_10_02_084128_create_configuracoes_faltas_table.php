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
        Schema::create('configuracoes_faltas', function (Blueprint $table) {
            $table->id();
            $table->string('nome_da_politica');
            $table->text('descricao')->nullable();
            $table->integer('limite_ausencias')->default(0);
            $table->enum('tipo_desconto', ['numerario', 'percentagem'])->default('numerario');
            $table->decimal('valor_desconto', 10, 2)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('configuracoes_faltas');
    }
};
