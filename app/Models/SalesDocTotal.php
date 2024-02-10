<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesDocTotal extends Model
{
    use HasFactory;

    protected $table = 'SalesDocumentTotals';
    protected $primaryKey = 'Id';
    public $timestamps = ['created_at', 'updated_at'];
    
    protected $fillable = [
        'tax_payable',
        'net_total',
        'gross_total',
        'payment_mechanism_id',
        'montante_pagamento',
        'data_pagamento',
        'documentoID',
    ];
}
