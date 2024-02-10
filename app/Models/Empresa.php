<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'Empresa';

    public function __construct(array $attributes = []){

        parent::__construct($attributes);

        // Obter a lista de colunas da tabela usando o Schema do Laravel
        $this->fillable = Schema::getColumnListing($this->table);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
