<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPhoto;
use App\Models\ProductSize;

class Product extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'article',
        'composite_article',
        'composition',
        'care',
        'price',
        'category_id',
    ];

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id');
    }

    public function crossSales()
    {
        return $this->hasMany(CrossSale::class, 'product_id');
    }

    public function crossSoldProducts()
    {
        return $this->hasManyThrough(Product::class, CrossSale::class, 'product_id', 'id', 'id', 'cross_sold_product_id');
    }
}
