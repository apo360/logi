<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaxTable extends Model
{
    use HasFactory;

    protected $table = 'TaxTable';

    protected $primaryKey = 'TaxCode';
    
    public $incrementing = false;

    protected $fillable = [
        'TaxType',
        'TaxCode',
        'TaxCountryRegion',
        'Description',
        'TaxExpirationDate',
        'TaxPercentage',
        'TaxAmount',
    ];

    protected $dates = [
        'TaxExpirationDate',
    ];

    public function salesLines()
    {
        return $this->hasMany(SalesLine::class, 'tax_id', 'TaxCode');
    }
}
