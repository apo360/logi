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
        Schema::create('Product_Service', function (Blueprint $table) {
            $table->id();
            $table->enum('ProductType', ['P', 'S', 'O', 'E', 'I']);
            $table->string('ProductCode', 60);
            $table->string('ProductGroup', 50)->nullable();
            $table->string('ProductDescription', 200)->nullable();
            $table->string('ProductNumberCode', 50)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('produtos');
    }
};
