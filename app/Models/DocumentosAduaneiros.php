<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DocumentosAduaneiros extends Model
{
    use HasFactory;

    protected $table = 'DocumentosAduaneiros'; // Nome da tabela

    protected $fillable = [
        'Fk_Importacao',
        'TipoDocumento',
        'NrDocumento',
        'DataEmissao',
        'Caminho',
        // Adicione outros campos fillable conforme necessário
    ];

    // Relacionamento com a tabela Importacao
    public function importacao()
    {
        return $this->belongsTo(Importacao::class, 'Fk_Importacao', 'Id');
    }
}
