<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Category;

class Product extends Model
{
    public $table = 'products';

    protected $fillable = [
        'product_name', 'product_desc', 'price', 'size',
    ];

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'product_category');
    }
}
