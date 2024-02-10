<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdutoPreco extends Model
{
    use HasFactory;

    protected $table = "product_prices";

    protected $fillable = [
        'unidade',
        'custo',
        'venda',
        'venda_sem_iva',
        'lucro',
        'factura',
        'imposto',
        'motivo',
    ];
}
