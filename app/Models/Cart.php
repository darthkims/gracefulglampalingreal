<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'promo_code_id',
        'total'
    ];

    protected $appends = [
        'grand_total'
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
        return $this->belongsToMany(Product::class, 'cart_product')
                    ->withPivot('quantity')
                    ->withTimestamps();
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

    public function getGrandTotalAttribute()
    {
        $this->calculateGrandTotal();
        return $this->total;
    }
}
