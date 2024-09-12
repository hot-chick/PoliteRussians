<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\ProductPhoto;

class product extends Model
{
    protected $fillable = [
        'id',
        'title',
        'description',
        'price',
        'category_id',
    ];

    public function photos()
    {
        return $this->hasMany(ProductPhoto::class);
    }
}
