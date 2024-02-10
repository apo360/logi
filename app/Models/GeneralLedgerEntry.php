<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralLedgerEntry extends Model
{
    use HasFactory;

    protected $fillable = [
        'NumberOfEntries',
        'TotalDebit',
        'TotalCredit',
        'JournalID',
        'Description',
        'TransactionID',
        'Period',
        'TransactionDate',
        'DocArchivalNumber',
        'TransactionType',
        'GLPostingDate',
        'CustomerID',
        'SupplierID',
    ];

    protected $dates = ['TransactionDate', 'GLPostingDate'];

    public function debitLine()
    {
        return $this->hasMany(DebitLine::class);
    }

    public function creditLine()
    {
        return $this->hasMany(CreditLine::class);
    }
}
