<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesStatus extends Model
{
    use HasFactory;

    protected $table = 'SalesDocumentStatus';

    protected $fillable = [
        'invoice_status',
        'invoice_status_date',
        'source_id',
        'source_billing',
    ];
}
