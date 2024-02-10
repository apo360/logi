<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductExemptionReason extends Model
{
    use HasFactory;

    protected $table = 'ProductExemptionReasons';
    protected $fillable = [
        'code',
        'name',
    ];
}
