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
        Schema::create('sales_invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_no')->unique();
            $table->string('invoice_type');
            $table->string('invoice_status');
            $table->dateTime('invoice_status_date');
            $table->string('source_id');
            $table->string('source_billing');
            $table->string('hash');
            $table->string('hash_control');
            $table->integer('period');
            $table->date('invoice_date');
            $table->integer('self_billing_indicator')->default(0);
            $table->integer('cash_vat_scheme_indicator')->default(0);
            $table->integer('third_parties_billing_indicator')->default(0);
            $table->string('source_id', 30);
            $table->string('eac_code', 10);
            $table->dateTime('system_entry_date');
            $table->string('transaction_id', 70);
            $table->string('customer_id', 70);
            $table->string('ship_to', 30)->nullable();
            $table->string('delivery_id', 30)->nullable();
            $table->date('delivery_date')->nullable();
            $table->string('warehouse_id', 30)->nullable();
            $table->string('location_id', 30)->nullable();
            $table->string('ship_from', 30)->nullable();
            $table->date('end_transport_date_time')->nullable();

            // Additional fields from DocumentTotals
            $table->decimal('tax_payable', 15, 2)->nullable();
            $table->decimal('net_total', 15, 2)->nullable();
            $table->decimal('gross_total', 15, 2)->nullable();
            $table->string('currency', 3)->nullable();
            $table->decimal('currency_amount', 15, 2)->nullable();
            $table->decimal('exchange_rate', 15, 2)->nullable();
            $table->timestamps();
        });

        // Line items
        Schema::create('sales_invoice_line_items', function (Blueprint $table) {
            $table->id(); // Adicione esta linha se quiser uma chave primária automática.
            $table->string('InvoiceNo', 20);
            $table->string('OriginatingON',60);
            $table->date('OrderDate');
            $table->integer('LineNumber');
            $table->integer('ProductID');
            $table->decimal('Quantity', 10, 2);
            $table->string('UnitOfMeasure', 10);
            $table->decimal('UnitPrice', 10, 2);
            $table->decimal('TaxBase', 10, 2);
            $table->date('TaxPointDate');
            $table->string('Description', 100);
            $table->decimal('CreditAmount', 10, 2);
            $table->decimal('DebitAmount', 10, 2);
            $table->integer('TaxID');
            $table->string('TaxExemptionReason', 200);
            $table->string('TaxExemptionCode', 10);
            $table->decimal('SettlementAmount', 10, 2);

            $table->timestamps();

            // Adicione a chave primária composta
            $table->primary(['InvoiceNo', 'LineNumber']);

            // Adicione a chave estrangeira
            $table->foreign('InvoiceNo')->references('invoice_no')->on('sales_invoices');
            $table->foreign('ProductID')->references('id')->on('Product_Service');
            $table->foreign('TaxID')->references('id')->on('impostos');
        
        });

        // DocumentStatus
        Schema::create('document_status', function (Blueprint $table) {
            $table->string('InvoiceNo', 20);
            $table->string('InvoiceStatus', 1);
            $table->dateTime('InvoiceStatusDate');
            $table->string('DocumentNumber', 20);
            $table->string('WorkStatus', 1);
            $table->dateTime('WorkStatusDate');
            $table->integer('SourceID');
            $table->string('SourceBilling', 1);
            $table->timestamps();

            $table->primary('InvoiceNo');
            $table->foreign('InvoiceNo')->references('InvoiceNo')->on('invoices');
            $table->foreign('DocumentNumber')->references('DocumentNumber')->on('work_documents');
        });

        // DocumentWorks
        Schema::create('work_documents', function (Blueprint $table) {
            $table->id();
            $table->string('DocumentNumber', 20);
            $table->string('Hash', 100);
            $table->integer('HashControl');
            $table->integer('Period');
            $table->date('WorkDate');
            $table->string('WorkType', 2);
            $table->integer('SourceID');
            $table->dateTime('SystemEntryDate');
            $table->integer('CustomerID');
            $table->timestamps();

            $table->primary(['Id', 'DocumentNumber']);
            $table->foreign('CustomerID')->references('Id')->on('customers');
        });

         // Settlement fields
        Schema::create('settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_invoice_id')->constrained();
            $table->decimal('discount', 10, 2);
            $table->date('discount_date');
            // ... outros atributos específicos para settlements
            $table->timestamps();
        });
        
         // Payment fields
         Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_invoice_id')->constrained();
            $table->string('payment_method');
            $table->decimal('amount', 10, 2);
            $table->date('payment_date');
            // ... outros atributos específicos para pagamentos
            $table->timestamps();
        });
        

         // WithholdingTax fields
         Schema::create('withholding_taxes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sales_invoice_id')->constrained();
            $table->string('tax_type');
            $table->string('withholding_tax_description');
            $table->decimal('withholding_tax_amount', 15, 2);
            // ... outros atributos específicos para retenção de imposto
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_invoices');
    }
};
