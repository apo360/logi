<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModuloMenu extends Model
{
    use HasFactory;
    
    protected $table = 'modulo_menus';
    
    public $timestamps = false;
    
    protected $fillable = [
        'modulo_id', 'menu_id',
    ];
    
    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
    
    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}
