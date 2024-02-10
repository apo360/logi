<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imposto extends Model
{
    use HasFactory;

    protected $fillable = [
        'TaxType',
        'TaxCountryRegion',
        'TaxCode',
        'Description',
        'TaxExpirationDate',
        'TaxPercentage',
        'TaxAmount',
    ];

    protected $dates = ['TaxExpirationDate'];
}
