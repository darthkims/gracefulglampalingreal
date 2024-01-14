<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cart = $user->cart;

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

        $products = $cart->products;

        $productTotals = [];
        foreach ($products as $product) {
            $productTotals[$product->id] = $product->price * $product->pivot->quantity;
        }

        $cartSubTotal = 0;
        foreach ($products as $product) {
            $cartSubTotal += $product->price * $product->pivot->quantity;
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
