<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $table = 'categories';

    protected $fillable = [
        'category_name',
    ];

    public function products()
    {
        return $this->belongsToMany(Product::class,  'product_category');
    }
}
