<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Invoice extends Model
{
    use HasFactory;

    protected $tableType = 'InvoiceType';
    
    protected $table = 'Invoice';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Obter a lista de colunas da tabela produtos usando o Schema do Laravel
        $this->fillable = Schema::getColumnListing($this->table);

    }

    public function documentStatus()
    {
        return $this->hasOne(DocumentStatus::class, 'InvoiceNo', 'InvoiceNo');
    }

    public function lines()
    {
        return $this->hasMany(Line::class, 'InvoiceNo', 'InvoiceNo');
    }
}
