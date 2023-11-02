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
        Schema::create('product_prices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fk_product');
            $table->string('unidade');
            $table->decimal('custo', 10, 2);
            $table->decimal('venda', 10, 2);
            $table->decimal('venda_sem_iva', 10, 2);
            $table->decimal('lucro', 10, 2);
            $table->string('factura');
            $table->decimal('imposto', 10, 2);
            $table->string('motivo');
            $table->timestamps();

            // Chave estrangeira para a tabela de produtos (substitua 'fk_product' pelo nome correto da coluna na sua tabela de produtos)
            $table->foreign('fk_product')->references('id')->on('Product')->onDelete('cascade');

            // Outros índices ou chaves estrangeiras, se necessário
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_prices');
    }
};
