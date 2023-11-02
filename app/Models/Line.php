<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Schema;

class Line extends Model
{
    use HasFactory;

    protected $table = 'Line';

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $this->fillable = Schema::getColumnListing($this->table);
    }

    public function invoice()
    {
        return $this->belongsTo(Invoice::class, 'InvoiceNo');
    }

    public function produto() {
        return $this->belongsTo(Produto::class, 'fk_Product');
    }

    public function taxa() {
        return $this->belongsTo(Taxa::class, 'TaxCode');
    }

    public function reason() {
        return $this->belongsTo(ProductExemptionReason::class, 'Fk_Reason');
    }
}
