<?php

namespace App\Http\Controllers\Customer;

use Auth;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cart = $user->cart;

        //count cart if cart is empty and has pending order which order PENDING PAYMENT
        $order = $user->orders()
            ->where('status', 'PENDING PAYMENT')
            ->latest()
            ->first();
        
        if ($order) {
            return redirect()->route('checkout');
        }

        // Ensure the cart exists
        if (!$cart) {
            $cart = new Cart();
            $user->cart()->save($cart);
        }

        $products = $cart->products;

        $productTotals = [];
        foreach ($products as $product) {
            $productTotals[$product->id] = $product->price * $product->pivot->quantity;
        }

        $cartSubTotal = 0;
        foreach ($products as $product) {
            $cartSubTotal += $product->price * $product->pivot->quantity;
        }

        $cartTotal=$cartSubTotal*1.1;
    
    
        return view('carts.index', compact('user', 'cart', 'products', 'productTotals', 'cartSubTotal', 'cartTotal'));
    }

    public function show()
    {
        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            // Create a new order
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $cart->total,
                'status' => 'PENDING PAYMENT',
            ]);

            // Transfer cart products to order products
            foreach ($cart->products as $cartProduct) {
                $order->products()->attach($cartProduct['pivot']['product_id'], [
                    'quantity' => $cartProduct['pivot']['quantity'],
                ]);
            }

            // Delete the user's cart and cart products
            $cart->products()->detach();
            $cart->delete();
        } 

        $order = $user->orders()
            ->where('status', 'PENDING PAYMENT')
            ->latest()
            ->first();

        if ($order) {
            $order->load('products');
            $productTotals = 0;

            foreach ($order->products as $product) {
                $productTotals += $product->price * $product->pivot->quantity;
            }

            $cartSubTotal = 0;
            foreach ($order->products as $product) {
                $cartSubTotal += $product->price * $product->pivot->quantity;
            }

            $products = $order->products;
        } 

        $cartTotal=$cartSubTotal*1.1+10;

        return view('carts.checkout', compact('user', 'cart', 'products', 'productTotals', 'cartSubTotal', 'cartTotal'));
    }

    public function addToCart(Request $request, $productId)
    {
        $user = auth()->user();
        $cart = $user->cart;

        // Create a cart for the user if they don't have one
        if (!$cart) {
            $cart = new Cart();
            $user->cart()->save($cart);
        }

        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('cart.index')->with('success', 'Product not found');
        }

        $existingProduct = $cart->products()->where('product_id', $productId)->first();

        if ($existingProduct) {
            // If the product is already in the cart, you might want to update quantity or do nothing
            $existingProduct->pivot->quantity += 1;
            $existingProduct->pivot->save();
        } else {
            // If the product is not in the cart, attach it
            $cart->products()->attach($productId, ['quantity' => 1]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart');
    }

    public function update(Request $request, $quantity)
    {
        $user = auth()->user();
        $cart = $user->cart;

        // Ensure the cart exists
        if (!$cart) {
            return redirect()->route('cart.index')->with('success', 'Cart not found');
        }

        $products = $request->input('products');

        foreach ($products as $productId => $quantity) {
            // Validate that the product exists
            $product = Product::find($productId);

            if ($product) {
                // Update the quantity for the specified product in the cart
                $cart->products()->updateExistingPivot($productId, ['quantity' => $quantity]);
            }
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully');
    }

    public function destroy($productId)
    {
        $user = auth()->user();
        $cart = $user->cart;

        // Ensure the cart exists
        if (!$cart) {
            return redirect()->route('cart.index')->with('success', 'Cart not found');
        }

        // Detach the product from the cart
        $cart->products()->detach($productId);

        return redirect()->route('cart.index')->with('success', 'Product removed from cart');
    }
}
