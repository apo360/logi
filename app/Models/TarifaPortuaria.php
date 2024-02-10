<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TarifaPortuaria extends Model
{
    use HasFactory;

    protected $table = 'TarifaPortuaria'; // Nome da tabela TarifaPortuaria

    protected $id = 'Id';

    protected $fillable = [
        'Fk_processo',
        'ep14',
        'ep17',
        'terminal',
    ];

    public function processo()
    {
        return $this->belongsTo(Processo::class, 'fk_processo');
    }
}
