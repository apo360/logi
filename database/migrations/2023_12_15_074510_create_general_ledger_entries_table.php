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
        Schema::create('general_ledger_entries', function (Blueprint $table) {
            $table->id(); // 1. Main Identifier
            $table->integer('NumberOfEntries'); // 2. Number of entries
            $table->decimal('TotalDebit', 10, 2); // 3. Total Debit
            $table->decimal('TotalCredit', 10, 2); // 4. Total Credit
            $table->string('JournalID', 30); // 5. Journal Identifier
            $table->string('Description', 60); // 6. Description
            $table->string('TransactionID'); // 7. Transaction Identifier
            $table->integer('Period'); // 8. Accounting Period
            $table->date('TransactionDate'); // 9. Transaction Date
            $table->string('DocArchivalNumber', 20); // 10. Document Archival Number
            $table->string('TransactionType', 1); // 11. Transaction Type
            $table->dateTime('GLPostingDate'); // 12. General Ledger Posting Date
            $table->string('CustomerID', 30)->nullable(); // 13. Customer Identifier
            $table->string('SupplierID', 30)->nullable(); // 14. Supplier Identifier
            $table->timestamps(); // Timestamps for record management
        });

        Schema::create('debit_lines', function (Blueprint $table) {
            $table->id(); // 1. Main Identifier
            $table->foreignId('general_ledger_entry_id')->constrained(); // 2. Foreign Key linking to general_ledger_entries
            // Add other fields for debit lines
            $table->timestamps(); // Timestamps for record management
        });

        Schema::create('credit_lines', function (Blueprint $table) {
            $table->id(); // 1. Main Identifier
            $table->foreignId('general_ledger_entry_id')->constrained(); // 2. Foreign Key linking to general_ledger_entries
            // Add other fields for credit lines
            $table->timestamps(); // Timestamps for record management
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('general_ledger_entries');
        Schema::dropIfExists('debit_lines');
        Schema::dropIfExists('credit_lines');
    }
};
