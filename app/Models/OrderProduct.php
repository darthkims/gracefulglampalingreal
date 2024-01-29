<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class OrderProduct extends Pivot
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'product_id',
        'location_id',
        'quantity'
    ];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }
}
