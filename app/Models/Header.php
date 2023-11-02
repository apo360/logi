<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Header extends Model
{
    use HasFactory;

    protected $table = 'header';
    protected $primaryKey = 'CompanyID';

    protected $fillable = [
        'AuditFileVersion',
        'TaxRegistrationNumber',
        'TaxAccountingBasis',
        'CompanyName',
        'FiscalYear',
        'StartDate',
        'EndDate',
        'CurrencyCode',
        'DateCreated',
        'TaxEntity',
        'ProductCompanyTaxID',
        'SoftwareValidationNumber',
        'ProductID',
        'ProductVersion',
        'Telephone',
        'Fax',
        'Email',
        'Website',
    ];

    protected $dates = [
        'StartDate',
        'EndDate',
        'DateCreated',
    ];
}
