<?php

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    public function index ()
    {
        $shoppingcarts = Cart::orderBy('created_at', 'desc')->get();

        return view('carts.index', compact('shoppingcarts'));
    }
}
