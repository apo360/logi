<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditLine extends Model
{
    use HasFactory;

    protected $fillable = [
        // Add other fields as needed
    ];

    public function generalLedgerEntry()
    {
        return $this->belongsTo(GeneralLedgerEntry::class);
    }
}
