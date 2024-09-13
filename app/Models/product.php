<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPhoto;
use App\Models\ProductSize;

class product extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'price',
        'composition',
        'category_id',
    ];

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }

    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'product_sizes', 'product_id', 'size_id');
    }
}
