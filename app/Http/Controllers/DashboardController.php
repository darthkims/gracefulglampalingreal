<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::all();
        $top_sales = DB::table('products')
            ->leftJoin('cart_product','products.id','=','cart_product.product_id')
            ->selectRaw('products.id, SUM(cart_product.quantity) as total')
            ->groupBy('products.id')
            ->orderBy('total','desc')
            ->take(4)
            ->get();
        $topProducts = [];
        foreach ($top_sales as $s){
            $p = Product::findOrFail($s->id);
            $p->totalQty = $s->total;
            $topProducts[] = $p;
        }
        
        $latest_products = DB::table('products')
            
            ->selectRaw('products.id, MAX(created_at) as latest_date')
            ->groupBy('products.id')
            ->orderByDesc('latest_date')
            ->take(4)
            ->get();
        $newProducts = [];
        foreach ($latest_products as $l){
            $q = Product::findOrFail($l->id);
            $q->totalQty = $l->latest_date;
            $newProducts[] = $q;
        }
        
        return view('products.main');
    }
}
