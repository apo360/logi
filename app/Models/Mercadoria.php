<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mercadoria extends Model
{
    use HasFactory;

    protected $table = 'Mercadorias';

    protected $fillable = [
        'Fk_Importacao',
        'Descricao',
        'NCM_HS',
        'NCM_HS_Numero',
        'Quantidade',
        'Qualificacao',
        'Unidade',
        'Peso',
        // Adicione outros campos fillable conforme necessário
    ];

    // Relacionamento com a tabela Importacao
    public function importacao()
    {
        return $this->belongsTo(Importacao::class, 'Fk_Importacao', 'Id');
    }


    // Outros relacionamentos e métodos necessários

    public function getTotalPeso()
    {
        // Retorna o peso total da mercadoria considerando a quantidade
        return $this->Peso * $this->quantidade;
    }

    public function getMarcaNumero()
    {
        // Retorna uma string com a marca e o número da mercadoria
        return $this->NCM_HS . ' - ' . $this->NCM_HS_Numero;
    }


    public function getQualificacaoDescricao()
    {
        // Retorna a descrição da qualificação da mercadoria, se existir
        return $this->Qualificacao;
    }

}
