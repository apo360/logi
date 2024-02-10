<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Importacao extends Model
{
    use HasFactory;

    protected $table = 'Importacao'; // Nome da tabela

    protected $fillable = [
        'Fk_processo',
        'Fk_pais',
        'PortoOrigem',
        'TipoTransporte',
        'NomeTransporte',
        'DataChegada',
        'MarcaFiscal',
        'BLC_Porte',
        'Moeda',
        'Cambio',
        'ValorAduaneiro',
        'ValorTotal',
        // Adicione outros campos fillable conforme necessário
    ];

    protected $dates = [
        'DataChegada',
        'created_at',
        'updated_at'
    ];

    public static function getLastInsertedId()
    {
        $ultimoImporte = self::latest()->first();

        if ($ultimoImporte) {
            return $ultimoImporte->Id;
        }

        return null;
    }

    // Relacionamento com a tabela Processos
    public function processo()
    {
        return $this->belongsTo(Processo::class, 'Fk_processo', 'ProcessoID');
    }

    // Relacionamento com a tabela DocumentosAduaneiros (se necessário)
    public function documentosAduaneiros()
    {
        return $this->hasMany(DocumentosAduaneiros::class, 'Fk_Importacao', 'Id');
    }

    // Relacionamento com a tabela Mercadorias
    public function mercadorias()
    {
        return $this->hasMany(Mercadoria::class, 'Fk_Importacao', 'Id');
    }

    // Defina outras propriedades do modelo, como timestamps e outros métodos, conforme necessário

}
