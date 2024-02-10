<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesInvoice extends Model
{
    use HasFactory;

    protected $table = 'SalesInvoice';
    protected $fillable = [
        'invoice_no',
        'hash',
        'hash_control',
        'period',
        'invoice_date',
        'invoice_type_id',
        'self_billing_indicator',
        'cash_vat_scheme_indicator',
        'third_parties_billing_indicator',
        'source_id',
        'system_entry_date',
        'transaction_id',
        'customer_id',
        'ship_to_id',
        'from_to_id',
        'movement_end_time',
        'movement_start_time',
        'imposto_retido',
        'motivo_retencao',
        'montante_retencao',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'invoice_date',
        'system_entry_date', // Assuming 'system_entry_date' is a date attribute
    ];

    public function getSystemEntryDate()
    {
        return $this->attributes['system_entry_date']->format('Y-m-d\TH:i:s');
    }


    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'source_id');
    }

    public function invoiceType()
    {
        return $this->belongsTo(InvoiceType::class);
    }
}
