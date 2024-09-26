<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    protected $fillable = [
        'id',
        'title'
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_sizes', 'size_id', 'product_id');
    }
}

