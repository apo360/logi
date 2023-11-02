<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Cobrado extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'cobrados_despacho';
    
    // Nome da coluna que é chave primária na tabela
    protected $primaryKey = 'id';

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

    /**
     * Implemente aqui a lógica para exibir as informações do registro de forma formatada
     */
    public function printData()
    {
        return [
            'ProcessoID' => $this->ProcessoID,
            'LicencaMinisterio' => $this->licenca_ministerio,
            'PreEmbarque' => $this->pre_embraque,
            
        ];
    }
}

