<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingAddress extends Model
{
    use HasFactory;

    protected $table = 'BillingAddress';

    protected $fillable = [
        'CustomerID',
        'BuildingNumber',
        'StreetName',
        'AddressDetail',
        'City',
        'PostalCode',
        'Country',
        'SupplierID',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'CustomerID' => 'integer',
        'SupplierID' => 'integer',
    ];

    // Relacionamento com Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID');
    }

    // Relacionamento com Supplier
    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'SupplierID');
    }

    // Acessador para o endereço completo
    public function getFullAddressAttribute()
    {
        return $this->BuildingNumber . ', ' . $this->StreetName . ', ' . $this->AddressDetail . ', ' . $this->City . ', ' . $this->PostalCode . ', ' . $this->Country;
    }

    // Mutador para formatar o CEP
    public function setPostalCodeAttribute($value)
    {
        $this->attributes['PostalCode'] = preg_replace('/[^0-9]/', '', $value);
    }
}
