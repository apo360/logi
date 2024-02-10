<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\SharedFieldsTrait;

class Supplier extends Model
{
    use HasFactory;

    use SharedFieldsTrait;

    protected $fillable = [
        'SupplierID',
        'AccountID',
        'SupplierTaxID',
        'CompanyName',
        'Contact',
        'BillingAddress_StreetName',
        'BillingAddress_BuildingNumber',
        'BillingAddress_AddressDetail',
        'City',
        'PostalCode',
        'Province',
        'Country',
        'Telephone',
        'Fax',
        'Email',
        'Website',
        'SelfBillingIndicator'
    ];
}
