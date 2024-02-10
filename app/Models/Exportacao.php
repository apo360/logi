<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exportacao extends Model
{
    use HasFactory;

    protected $table = 'Exportacao'; // Nome da tabela

    protected $fillable = [
        'Fk_processo',
        'Fk_pais_origem',
        'Fk_pais_destino',
        'PortoEmbarque',
        'TipoTransporte',
        'NomeTransporte',
        'DataEmbarque',
        'ValorFOB',
        'MoedaFOB',
        'ValorTotal',
        // Adicione outros campos fillable conforme necessário
    ];

    // Relacionamento com a tabela Processos
    public function processo()
    {
        return $this->belongsTo(Processo::class, 'Fk_processo', 'ProcessoID');
    }

    // Defina outras propriedades do modelo, como timestamps e outros métodos, conforme necessário

}
