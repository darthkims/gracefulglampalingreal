<?php

namespace App\Http\Controllers;

use App\Models\Brand;
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
        $brands = Brand::all();
        $sort = $request->input('sort', 'newest');
        $selectedCategory = $request->input('category');
        $selectedSize = $request->input('size');
        $selectedBrand = $request->input('brand');

        // Fetch products and apply sorting based on $sort value
        $products = Product::query();

        // Add sorting based on the selected option
        switch ($sort) {
            case 'low_to_high':
                $products->orderBy('price', 'asc');
                break;
            case 'high_to_low':
                $products->orderBy('price', 'desc');
                break;
            case 'newest':
                $products->orderBy('created_at', 'desc');
                break;
            // Add more cases as needed...
        }

        // Filter by selected category if it's provided
        if ($selectedCategory) {
            $products->whereHas('categories', function ($query) use ($selectedCategory) {
                $query->where('categories.id', $selectedCategory);
            });
        }

        if ($selectedBrand) {
            $products->whereHas('brands', function ($query) use ($selectedBrand) {
                $query->where('brands.id', $selectedBrand);
            });
        }

        // Filter by selected size if it's provided
        if ($selectedSize) {
            $products->whereHas('sizes', function ($query) use ($selectedSize) {
                $query->where('sizes.id', $selectedSize);
            });
        }

        // Get the results after applying sorting and filtering
        $products = $products->get();

        return view('products.shop', compact('products', 'categories', 'sizes', 'brands', 'selectedCategory', 'selectedSize', 'selectedBrand'));
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
