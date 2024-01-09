<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Fetch and return the user's carts
        $carts = auth()->user()->carts;

        return view('customer.carts.index', compact('carts'));
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
}
