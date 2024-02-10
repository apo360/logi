<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cambio extends Model
{
    use HasFactory;

    protected $table = 'Cambios';

    protected $fillable = [
        'dataactual',
        'GBP',
        'EUR',
        'USD',
        'ZAR',
    ];
}
