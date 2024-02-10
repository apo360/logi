<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class TarifaDU extends Model
{
    use HasFactory;

    protected $table = 'TarifaDU'; // Nome da tabela TarifaDU

    protected $id = 'Id';

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

    public function processo()
    {
        return $this->belongsTo(Processo::class, 'fk_processo');
    }
}