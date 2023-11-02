<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Portuaria extends Model
{
    use HasFactory;

    protected $table = 'portuaria';

    /**
     * Construtor da classe Cobrado.
     * Define os atributos que podem ser preenchidos em massa
     * 
     * @param array $attributes Atributos do modelo
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Obter a lista de colunas da tabela usando o Schema do Laravel
        $this->fillable = Schema::getColumnListing($this->table);
    }

    // Relacionamento com Customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'CustomerID');
    }
}
