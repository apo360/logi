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
        Schema::create('Cambios', function (Blueprint $table) {
            $table->id();
            $table->date('dataactual');
            $table->decimal('GBP', 10, 2);
            $table->decimal('EUR', 10, 2);
            $table->decimal('USD', 10, 2);
            $table->decimal('ZAR', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Cambios');
    }
};
