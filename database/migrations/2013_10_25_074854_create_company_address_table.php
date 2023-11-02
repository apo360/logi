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
        Schema::create('company_address', function (Blueprint $table) {
            $table->id();
            $table->string('CompanyID', 50);
            $table->string('AddressDetail', 210)->nullable(false);
            $table->string('City', 50)->nullable(false);
            $table->string('PostalCode', 10)->nullable();
            $table->string('Province', 50)->nullable();
            $table->string('Country', 2)->nullable(false);
            $table->timestamps();

            $table->foreign('CompanyID')->references('CompanyID')->on('Header');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('company_address');
    }
};
