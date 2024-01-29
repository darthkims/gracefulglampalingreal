<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $cart = $user->cart;

        //count cart if cart is empty and has pending order which order pendings
        $order = $user->orders()
            ->where('status', 'pending')
            ->latest()
            ->first();
        
        // if ($order) {
        //     return redirect()->route('checkout');
        // }

        // Ensure the cart exists
        if (!$cart) {
            $cart = new Cart();
            $user->cart()->save($cart);
        }

        $products = $cart->products()->with('locations')->get();

        $productTotals = [];
        foreach ($products as $product) {
            $productTotals[$product->id] = $product->price * $product->pivot->quantity;
            $locations = $product->locations; 
        }

        $cartSubTotal = 0;
        foreach ($products as $product) {
            $cartSubTotal += $product->price * $product->pivot->quantity;
        }

        $cartTotal=$cartSubTotal*1.1;
    
    
        return view('carts.index', compact('user', 'cart', 'products', 'productTotals', 'cartSubTotal', 'cartTotal'));
    }

    public function confirm()
    {
        $user = auth()->user();
        $cart = $user->cart;

        //count cart if cart is empty and has pending order which order pendings
        $order = $user->orders()
            ->where('status', 'pending')
            ->latest()
            ->first();
        
        // if ($order) {
        //     return redirect()->route('checkout');
        // }

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

        $cartTotal=$cartSubTotal*1.1+10;
    
    
        return view('carts.beforecheckout', compact('user', 'cart', 'products', 'productTotals', 'cartSubTotal', 'cartTotal'));
    }

    public function checkoutRedirect(Request $request)
    {
        $user = Auth::user();
        $cart = $user->cart;

        if ($cart) {
            // Create a new order
            $order = Order::create([
                'user_id' => $user->id,
                'total' => $cart->grand_total,
                'status' => 'pending',
                'order_status' => 'To Pay',
            ]);

            // Transfer cart products to order products
            foreach ($cart->products as $cartProduct) {
                $order->products()->attach($cartProduct['pivot']['product_id'], [
                    'quantity' => $cartProduct['pivot']['quantity'],
                    'location_id' => $cartProduct['pivot']['location_id'],
                ]);
            }

            // Delete the user's cart and cart products
            $cart->products()->detach();
            $cart->delete();

            return redirect()->route('checkout.redirect', ['orderId' => $order->id]);
        }

        // Check if orderId is provided and valid
        if ($request->orderId) {
            $order = Order::find($request->orderId);
            if ($order) {
                $order->load('products');
                $products = $order->products;

                return view('carts.checkout', compact('user', 'order', 'products'));
            }
        }

        return "Error: Order not found";
    }

    public function checkout(Request $request) 
    {
        $user = Auth::user();
        $order = Order::with('products')->where('id', $request->orderId)->first();
        if ($order) {
            $order->load('products');
            $products = $order->products;
        } 

        return view('carts.checkout', compact('user', 'order', 'products'));
    }

    public function addToCart(Request $request, $productId, $quantity = 1)
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
            return redirect()->route('cart.index')->with('error', 'Product not found');
        }
    
        $existingProduct = $cart->products()->where('product_id', $productId)->first();
        $quantity = $request->input('quantity', 1);
    
        if ($existingProduct) {
            // If the product is already in the cart, update quantity
            $existingProduct->pivot->quantity += $quantity;
            $existingProduct->pivot->save();
        } else {
            // If the product is not in the cart, attach it with the given quantity
            $cart->products()->attach($productId, ['quantity' => $quantity]);
        }
    
        return redirect()->to(route('cart.index') . '#success-alert')->with('success', 'Product added to cart');
    }
    

    public function update(Request $request)
    {
        $quantities = $request->input('quantities');
        $storeLocations = $request->input('store_locations');
    
        // Loop through the submitted quantities and update the cart
        foreach ($quantities as $productId => $quantity) {
            // You may want to add validation to ensure the product exists in the cart
            $product = Product::find($productId);
    
            // Assuming you have a relationship between User and Cart models
            auth()->user()->cart->products()->updateExistingPivot($productId, [
                'quantity' => $quantity,
                'location_id' => $storeLocations[$productId] ?? null, // Use null if location is not provided
            ]);
        }
        
    
        // Optionally, you can return a response or redirect back to the cart page
        return redirect()->to(route('cart.index') . '#success-alert')->with('success', 'Cart updated successfully');
    }
    

    public function destroy($productId)
    {
        $user = auth()->user();
        $cart = $user->cart;

        // Ensure the cart exists
        if (!$cart) {
            return redirect()->to(route('cart.index') . '#success-alert')->with('success', 'Cart not found');
        }

        // Detach the product from the cart
        $cart->products()->detach($productId);

        return redirect()->to(route('cart.index') . '#success-alert')->with('success', 'Product removed from cart');
    }
}
