<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equivalencia extends Model
{
    use HasFactory;

    protected $table = 'equivalencia';

    protected $fillable = [
        'ProcessoID',
        'Moeda',
        'ValorME',
        'CambioKZ',
        'ValorAduaneiro',
        'created_at',
        'updated_at',
    ];

    protected $casts = [
        'ProcessoID' => 'integer',
        'ValorME' => 'decimal:2',
        'CambioKZ' => 'decimal:2',
        'ValorAduaneiro' => 'decimal:2',
    ];

    // Relacionamento com Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID');
    }
}
