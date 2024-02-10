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
        Schema::create('accounts', function (Blueprint $table) {
            $table->id();
            $table->string('AccountID')->unique();
            $table->string('AccountDescription', 30);
            $table->enum('GroupingCategory', ['GR', 'GA', 'GM', 'AR', 'AA', 'AM']);
            $table->string('GroupingCode', 2)->nullable();
            $table->decimal('OpeningDebitBalance', 15, 2)->default(0);
            $table->decimal('OpeningCreditBalance', 15, 2)->default(0);
            $table->decimal('ClosingDebitBalance', 15, 2)->default(0);
            $table->decimal('ClosingCreditBalance', 15, 2)->default(0);
            $table->timestamps();

            // Add foreign key constraint for the grouping code
            $table->foreign('GroupingCode')->references('AccountID')->on('accounts');
        });

        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('accounts');
    }
};
