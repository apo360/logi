<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mercadoria extends Model
{
    use HasFactory;

    protected $table = 'mercadoria';

    protected $fillable = [
        'MercadoriaID',
        'ProcessoID',
        'marcas',
        'numero',
        'quantidade',
        'qualificacaoID',
        'designacao',
        'peso'
    ];

    public function processo()
    {
        return $this->belongsTo(Processo::class, 'ProcessoID');
    }

    public function qualificacao()
    {
        return $this->belongsTo(Qualificacao::class, 'qualificacaoID');
    }

    // Outros relacionamentos e métodos necessários

    public function getTotalPeso()
    {
        // Retorna o peso total da mercadoria considerando a quantidade
        return $this->peso * $this->quantidade;
    }

    public function getMarcaNumero()
    {
        // Retorna uma string com a marca e o número da mercadoria
        return $this->marcas . ' - ' . $this->numero;
    }

    public function isQualificada()
    {
        // Verifica se a mercadoria possui uma qualificação associada
        return $this->qualificacaoID !== null;
    }

    public function getQualificacaoDescricao()
    {
        // Retorna a descrição da qualificação da mercadoria, se existir
        return $this->qualificacao ? $this->qualificacao->descricao : null;
    }

    public function getNomeCliente()
    {
        // Retorna o nome do cliente associado ao processo da mercadoria
        return $this->processo->cliente->nome;
    }

    public function updateQuantidade($novaQuantidade)
    {
        // Atualiza a quantidade da mercadoria
        $this->quantidade = $novaQuantidade;
        $this->save();
    }
}
