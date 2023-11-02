<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    
    /**
     * Construtor da classe Cobrado.
     * Define os atributos que podem ser preenchidos em massa
     * 
     * @param array $attributes Atributos do modelo
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Obter a lista de colunas da tabela usando o Schema do Laravel
        $this->fillable = Schema::getColumnListing($this->table);
    }
    
    public function modulo()
    {
        return $this->belongsTo(Modulo::class, 'modulo_id');
    }
    
    // Menu Pai (Menu Principal)
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }
    
    // Menu Filho (Sub-Menu)
    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }
    
    public function modulos()
    {
        return $this->belongsToMany(Modulo::class, 'modulo_menus', 'menu_id', 'modulo_id');
    }
}
