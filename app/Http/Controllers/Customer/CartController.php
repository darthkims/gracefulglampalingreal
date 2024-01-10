<?php

namespace App\Http\Controllers\Customer;

use App\Models\Cart;
use App\Models\Product;
use App\Models\PromoCode;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    public function index()
    {
        // Fetch and return the user's carts
        $carts = auth()->user()->carts;
        return view('carts.index', compact('carts'));
    }

    public function create()
    {
        // You may not need a separate create method for carts, as they are typically created during the 'store' operation.
        // However, you can add logic here if needed.
        return view('customer.carts.create');
    }

    public function store(Request $request)
    {
        // Add logic to add products to the cart
        // For example, add a product with a given quantity to the user's cart

        // Sample logic (modify as per your application requirements):
        $user = auth()->user();
        $cart = $user->carts()->create([
            'promo_code_id' => $request->input('promo_code_id'),
            'total' => 0, // You may want to calculate the total based on products in the cart
        ]);

        // Assuming you have product_id and quantity in the request
        $cart->products()->attach($request->input('product_id'), ['quantity' => $request->input('quantity')]);

        return redirect()->route('customer.carts.index')->with('message', 'Product added to cart successfully');
    }

    public function edit($id)
    {
        $cart = Cart::findOrFail($id);

        return view('customer.carts.edit', compact('cart'));
    }

    public function update(Request $request, $id)
    {
        // Add logic to update cart details if needed
        // For example, update promo code or quantity of products in the cart

        // Sample logic (modify as per your application requirements):
        $cart = Cart::findOrFail($id);
        $cart->update([
            'promo_code_id' => $request->input('promo_code_id'),
            // Update other fields as needed
        ]);

        return redirect()->route('customer.carts.index')->with('message', 'Cart updated successfully');
    }

    public function destroy($id)
    {
        $cart = Cart::findOrFail($id);

        // Add logic to remove the cart and associated products from the database

        // Sample logic (modify as per your application requirements):
        $cart->delete();

        return redirect()->route('customer.carts.index')->with('message', 'Cart deleted successfully');
    }

    public function addToCart(Request $request)
    {
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');

        $product = Product::find($productId);

        if (!$product) {
            return response()->json(['error' => 'Product not found'], 404);
        }

        $user_id = auth()->id();
        $cart = Cart::updateOrCreate(['user_id' => $user_id], []);

        // Check if the product is already in the cart
        $existingProduct = $cart->products()->find($productId);

        if ($existingProduct) {
            // If the product exists in the cart, update the quantity
            $cart->products()->updateExistingPivot($productId, ['quantity' => $quantity + $existingProduct->pivot->quantity]);
        } else {
            // If the product is not in the cart, attach it with the quantity
            $cart->products()->attach($productId, ['quantity' => $quantity]);
        }

        // Update the cart total based on the updated quantities
        $cart->update(['total' => $this->calculateTotal($cart)]);

        // Save the updated cart to the session
        session()->put('cart', $cart);

        return response()->json(['success' => 'Product added to cart']);
    }

    public function showCart()
    {
        $cart = Cart::with(['products', 'promoCode'])->where('user_id', auth()->id())->first();

        return view('carts.index', compact('cart'));
    }

    public function updateCart(Request $request)
    {
        $cartId = $request->input('cart_id');
        $productUpdates = $request->input('products');
    
        $cart = Cart::findOrFail($cartId);
    
        foreach ($productUpdates as $productId => $quantity) {
            // Check if the product is already in the cart
            $existingProduct = $cart->products()->find($productId);
    
            if ($existingProduct) {
                // If the product exists in the cart, update the quantity
                $cart->products()->updateExistingPivot($productId, ['quantity' => $quantity]);
            } else {
                // If the product is not in the cart, attach it with the quantity
                $cart->products()->attach($productId, ['quantity' => $quantity]);
            }
        }
    
        // Update the cart total based on the updated quantities
        $cart->update(['total' => $this->calculateTotal($cart)]);
    
        // Save the updated cart to the session
        session()->put('cart', $cart);
    
        return response()->json(['success' => 'Cart updated successfully']);
    }    

    //create function to apply promo code and get request cart id
    public function applyPromo(Request $request)
    {
        $cartId = $request->input('cart_id');
        $promoCode = $request->input('promo_code');

        $cart = Cart::findOrFail($cartId);

        // Check if the promo code exists
        $promoCode = PromoCode::where('name', $promoCode)->first();

        if (!$promoCode) {
            return response()->json(['error' => 'Invalid promo code'], 404);
        }

        // Update the cart with the promo code
        $cart->update(['promo_code_id' => $promoCode->id]);

        // Update the cart total based on the updated quantities
        $cart->update(['total' => $this->calculateTotal($cart)]);

        // Save the updated cart to the session
        session()->put('cart', $cart);

        return response()->json(['success' => 'Promo code applied successfully']);
    }

    public function removeCart(Request $request)
    {
        // $cart = Cart::session(auth()->id());=
        $cart = Cart::findOrFail($request->input('cart_id'));
        $product = Product::findOrFail($request->input('product_id'));

        // Remove the product from the cart
        $cart->products()->detach($product->id);

        // Update the cart total
        $cart->update();

        // Save the updated cart to the session
        session()->put('cart', $cart);

        return response()->json(['success' => 'Product removed from cart.']);
    }

    // Helper method to calculate total based on the products in the cart
    private function calculateTotal(Cart $cart)
    {
        $total = 0;

        foreach ($cart->products as $product) {
            $total += $product->pivot->quantity * $product->price;
        }

        return $total;
    }
}
