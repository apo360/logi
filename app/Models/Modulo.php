<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modulo extends Model
{
    use HasFactory;

    protected $table = 'modules';
    
    protected $fillable = [
        'parent_id', 'module_name', 'description', 'price',
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

