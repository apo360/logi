<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Departamento extends Model
{
    use HasFactory;

    protected $table = "departments";

    protected $fillable = [
        'cod',
        'name',
        'manager_id',
    ];

    public function manager() {
        return $this->belongsTo(Funcionario::class, 'manager_id');
    }
    
}
