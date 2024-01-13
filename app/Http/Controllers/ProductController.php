<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use File;
use App\Models\Size;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $categories = Category::all();
        $sizes = Size::all();
        $sort = $request->input('sort', 'low_to_high');
        $selectedCategory = $request->input('category');
        $selectedSize = $request->input('size'); // Add this line to get the selected size
        
        // Fetch products and apply sorting based on $sort value
        $products = Product::orderBy('price', $sort === 'low_to_high' ? 'asc' : 'desc');
        
        // Filter by selected category if it's provided
        if ($selectedCategory) {
            $products->whereHas('categories', function ($query) use ($selectedCategory) {
                $query->where('categories.id', $selectedCategory); // Specify the table alias or full table name
            });
        }
    
        // Filter by selected size if it's provided
        if ($selectedSize) {
            $products->whereHas('sizes', function ($query) use ($selectedSize) {
                $query->where('sizes.id', $selectedSize); // Specify the table alias or full table name
            });
        }
        
        $products = $products->get();
        
        return view('products.shop', compact('products', 'categories', 'sizes', 'selectedCategory', 'selectedSize'));
    }
    
    
    

    public function display(Product $product, Request $request)
    {

        /**
         * $product = Product::with(['colors', 'sizes', 'brands', 'categories'])->where('id', $product->id)->first();
         * method load() is used to eager load the relationships, the output is the same as the above
         */
        $product->load(['colors', 'sizes', 'brands', 'categories']);

        
        // to display related products
        $currentProductId = $product->id;
        $products = Product::where('id', '!=', $currentProductId)->get();
        $randomIds = $products->pluck('id')->unique()->random(4)->toArray();

        return view('products.display', compact('product', 'randomIds'));    
    }

}
