<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CrossSale extends Model
{
    protected $table = 'cross_sales';

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function crossSoldProduct()
    {
        return $this->belongsTo(Product::class, 'cross_sold_product_id');
    }
}
