<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_number',
        'user_id', 
        'promo_code_id',
        'status',
        'total',
    ];

    protected $appends = [
        'grand_total',
        'sub_total'
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
                    ->using(OrderProduct::class)
                    ->withPivot([
                        'quantity',
                        'location_id',
                    ])
                    ->withTimestamps();
    }

    public function getProductsWithLocation()
    {
        return $this->products->map(function ($product) {
            $location = Location::find($product->pivot->location_id);
            $product->location = $location;
            return $product;
        });
    }

    public function calculateGrandTotal()
    {
        $productTotals = 0;

        foreach ($this->products as $product) {
            $productTotals += $product->price * $product->pivot->quantity;
        }

        // Calculate total with 10% fee and delivery fee
        $total = $productTotals * 1.1 + 10;

        // Apply promo code discount if applicable
        if ($this->promoCode) {
            $total -= $total * ($this->promoCode->discount_percentage / 100);
        }

        // Set the calculated total to the model's total attribute
        $this->total = max(0, $total); // Ensure total is non-negative
    }

    public function calculateSubTotal()
    {
        $productTotals = 0;

        foreach ($this->products as $product) {
            $productTotals += $product->price * $product->pivot->quantity;
        }

        // Calculate total 
        $total = $productTotals;

        // Apply promo code discount if applicable
        if ($this->promoCode) {
            $total -= $total * ($this->promoCode->discount_percentage / 100);
        }

        // Set the calculated total to the model's total attribute
        $this->total = max(0, $total); // Ensure total is non-negative
    }

    public function getGrandTotalAttribute()
    {
        $this->calculateGrandTotal();
        return $this->total;
    }

    public function getSubTotalAttribute()
    {
        $this->calculateSubTotal();
        return $this->total;
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
