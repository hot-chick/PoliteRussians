<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = [
        'order_number', 
        'items', 
        'total_price', 
        'payment_status', 
        'payment_method'
    ];

    protected $casts = [
        'items' => 'array',
    ];
}
