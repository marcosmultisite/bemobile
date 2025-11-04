<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

// Pode estender Model ou Pivot, Pivot é mais específico para esta necessidade
class TransactionProduct extends Pivot
{
    protected $table = 'transaction_products';
    
    protected $fillable = [
        'transaction_id',
        'product_id',
        'quantity',
    ];

    public $timestamps = false; // Tabela pivot geralmente não tem timestamps
}
