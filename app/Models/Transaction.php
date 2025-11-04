<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'gateway_id',
        'external_id',
        'status',
        'amount',
        'card_last_numbers',
    ];
    
    // Relacionamento com produtos (muitos-para-muitos)
    public function products()
    {
        return $this->belongsToMany(Product::class, 'transaction_products')
                    ->withPivot('quantity'); // Acessar a quantidade via pivot
    }

    // Relacionamento com cliente
    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    // Relacionamento com gateway
    public function gateway()
    {
        return $this->belongsTo(Gateway::class);
    }
}
