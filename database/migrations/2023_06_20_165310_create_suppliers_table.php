<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Traits\SharedFieldsTrait;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    use SharedFieldsTrait;
    
    public function up(): void
    {
         Schema::create('suppliers', function (Blueprint $table) {
            $table->id();
            $table->string('SupplierID')->unique();
            $table->string('AccountID');
            $table->string('SupplierTaxID');
            $this->sharedFields($table);
            $table->timestamps();

            // Add foreign key constraint for the account ID
            $table->foreign('AccountID')->references('AccountID')->on('accounts');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
