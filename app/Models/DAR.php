<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DAR extends Model
{
    use HasFactory;

    protected $table = 'tb_dar';

    protected $fillable = [
        'ProcessoID',
        'NrReceita',
        'DataDar',
    ];

    protected $dates = [
        'DataDar',
        'created_at',
        'updated_at'
    ];

    function processo(){
        return $this->belongsTo(Processo::class, 'ProcessoID');
    }
}
