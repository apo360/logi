<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'modulos';
    
    protected $fillable = [
        'nome', 'sigla', 'posicao', 'activado',
    ];
    
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'modulo_menus', 'modulo_id', 'menu_id');
    }

    // Método para listar módulos ativos
    public function scopeAtivo($query)
    {
        return $query->where('activado', true);
    }
}

