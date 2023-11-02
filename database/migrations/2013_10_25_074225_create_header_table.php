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
        Schema::create('header', function (Blueprint $table) {
            $table->string('AuditFileVersion', 10);
            $table->string('CompanyID', 50)->primary();
            $table->string('TaxRegistrationNumber', 15);
            $table->char('TaxAccountingBasis', 1);
            $table->string('CompanyName', 100);
            $table->integer('FiscalYear');
            $table->date('StartDate');
            $table->date('EndDate');
            $table->string('CurrencyCode', 3);
            $table->date('DateCreated');
            $table->string('TaxEntity', 50);
            $table->string('ProductCompanyTaxID', 10);
            $table->string('SoftwareValidationNumber', 20);
            $table->string('ProductID', 100);
            $table->string('ProductVersion', 20);
            $table->string('Telephone', 20);
            $table->string('Fax', 20);
            $table->string('Email', 100);
            $table->string('Website', 100);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('header');
    }
};
