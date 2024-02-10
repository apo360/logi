<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
    use HasFactory;

    protected $table = 'Tarifas'; // Nome da tabela comum para todas as tarifas

    protected $fillable = [
        'fk_dar',
        'fk_du',
        'fk_portuaria',
        'totaldar',
        'totaldu',
        'totalportuaria',
    ];

    public function dar()
    {
        return $this->belongsTo(TarifaDAR::class, 'fk_dar');
    }

    public function du()
    {
        return $this->belongsTo(TarifaDU::class, 'fk_du');
    }

    public function portuaria()
    {
        return $this->belongsTo(TarifaPortuaria::class, 'fk_portuaria');
    }
}
