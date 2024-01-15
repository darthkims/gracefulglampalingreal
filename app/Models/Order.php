<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id', 
        'promo_code_id',
        'total',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promoCode()
    {
        return $this->belongsTo(PromoCode::class, 'promo_code_id');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'order_product')
                    ->withPivot('quantity')
                    ->withTimestamps();
    }

    protected static function boot()
    {
        parent::boot();

        // When creating a new order, automatically set the order_number
        static::creating(function ($order) {
            $order->order_number = 'GG' . now()->format('Ym') . static::generateIncrementNumber();
        });
    }

    // Generate an increment number based on the current month
    protected static function generateIncrementNumber()
    {
        $lastOrder = static::orderBy('id', 'desc')->first();

        if ($lastOrder) {
            $lastOrderNumber = $lastOrder->order_number;

            // Extract the numeric part and increment it
            $numericPart = (int) substr($lastOrderNumber, -3);
            $newNumericPart = $numericPart + 1;

            // Pad the new numeric part with zeros to ensure it has three digits
            $newNumericPart = str_pad($newNumericPart, 3, '0', STR_PAD_LEFT);

            return $newNumericPart;
        } else {
            // If no previous orders exist, start with 001
            return '001';
        }
    }
}
