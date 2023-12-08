<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';
    protected $primaryKey = 'product_ID'; // Add this line

    protected $fillable = [
        'product_name', 'product_desc', 'price',
    ];
}
