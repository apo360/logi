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
        Schema::create('activated_modules', function (Blueprint $table) {
            $table->id();
            $table->Integer('company_id');
            $table->unsignedBigInteger('module_id');
            $table->timestamp('activation_date')->default(now());
            $table->timestamps();

            $table->foreign('company_id')->references('Id')->on('Empresa');
            $table->foreign('module_id')->references('id')->on('modules');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('activated_modules');
    }
};
