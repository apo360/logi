<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Arquivo extends Model
{
    use HasFactory;

    protected $table = 'Arquivos';
    protected $primaryKey = 'ArquivoID';
    protected $fillable = [
        'ProcessoID',
        'Nome',
        'Tipo',
        'Caminho',
        'data',
    ];

    public function processo()
    {
        return $this->belongsTo(Processo::class, 'ProcessoID');
    }
}
