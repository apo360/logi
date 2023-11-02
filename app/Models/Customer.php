<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'Customer';

    protected $fillable = [
        'CustomerID',
        'AccountID',
        'CustomerTaxID',
        'CompanyName',
        'Telephone',
        'Email',
        'Website',
        'SelfBillingIndicator'
    ];

    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public static function generateNewCode()
    {
        return DB::select('CALL ClienteNewCod()')[0]->codigoCliente;
    }

    public function endereco(){
        return $this->hasOne(BillingAddress::class, 'CustomerID');
    }

    /**
     * Define the "invoices" relationship. Each customer can have multiple invoices.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'CustomerID');
    }

    /**
     * Define the "processes" relationship. Each customer can have multiple processes.
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function processes()
    {
        return $this->hasMany(Process::class, 'CustomerID');
    }
}
