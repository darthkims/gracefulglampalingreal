<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::all();
        return view('products.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
    
        return view('products.create', compact('categories'));
    }

    /**
    * Store a newly created resource in storage.
    */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'price' => 'required',
            'size' => 'required',
            'product_category' => 'required|array', // Make sure 'categories' is an array
        ]);

        $product = Product::create([
            'product_name' => $request->input('product_name'),
            'product_desc' => $request->input('product_desc'),
            'price' => $request->input('price'),
            'size' => $request->input('size'),
        ]);

        $product->categories()->attach($request->input('product_category'));

        return redirect()->route('products.index')
                        ->with('success', 'Product created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

        $nextProduct = Product::where('id', '>', $product->id)->first();
        $prevProduct = Product::where('id', '<', $product->id)->latest()->first();

        return view('products.show', compact('product', 'nextProduct', 'prevProduct'));    
    }
    
    public function display(Product $product)
    {
        return view('products.display', compact('product'));    
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $categories = Category::all();
        
        return view('products.edit',compact('product','categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'product_name' => 'required',
            'product_desc' => 'required',
            'price' => 'required',
            'size' => 'required',
            'product_category' => 'required|array', // Make sure 'product_category' is an array
        ]);
    
        $product->update([
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'price' => $request->price,
            'size' => $request->size,
        ]);
    
        // Sync the selected categories
        $product->categories()->sync($request->input('product_category'));
    
        return redirect()->route('products.index')->with('success', 'Product updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        // Detach categories before deleting the product
        $product->categories()->detach();

        $product->delete();
  
        return redirect()->route('products.index')
                        ->with('success','Product deleted successfully');
    }
}
