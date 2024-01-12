<?php

namespace App\Http\Controllers;

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
        $relatedProducts = Product::with(['colors', 'sizes', 'brands', 'categories'])
            ->whereHas('categories', function ($query) use ($product) {
                $query->whereIn('categories.id', $product->categories->pluck('id'));
            })
            ->where('id', '!=', $product->id)
            ->limit(4)
            ->get();

        return view('products.display', compact('product', 'relatedProducts'));    
    }

    /**
     * Show the form for creating a new resource.
     */


    /**
    * Store a newly created resource in storage.
    */
    /**
     * Display the specified resource.
     */
    // public function show(Product $product)
    // {

    //     $nextProduct = Product::where('id', '>', $product->id)->first();
    //     $prevProduct = Product::where('id', '<', $product->id)->orderBy('id', 'desc')->first();

    //     return view('products.show', compact('product', 'nextProduct', 'prevProduct'));    
    // }
    

    /**
     * Show the form for editing the specified resource.
     */
    /**
     * Update the specified resource in storage.
     */
}
