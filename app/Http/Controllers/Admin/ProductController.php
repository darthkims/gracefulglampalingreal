<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();

        return view('admin.product.index',compact('products'));
    }

    public function create()
    {
        $categories = Category::all();
        $sizes = Size::all();
        $colors = Color::all();
        $brands = Brand::all();
    
        return view('admin.product.create', compact('categories', 'sizes', 'colors', 'brands'));
    }

    public function store(Request $request)
    {
        // validate the data
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'brand' => 'required|exists:brands,id',
            'categories' => 'required|array',
            'categories.*' => 'exists:categories,id',
            'sizes' => 'required|array',
            'sizes.*' => 'exists:sizes,id',
            'colors' => 'required|array',
            'colors.*' => 'exists:colors,id',
            'product_image' => 'image|mimes:jpg|max:5120',
        ]);
    
        $product = Product::create([
            'name' => $request->input('name'),
            'price' => $request->input('price'),
            'description' => $request->input('description'),
        ]);
    
        // Handle file upload
        $productId = $product->id;
    
        if ($request->hasFile('product_image')) {
            $image = $request->file('product_image');
            $imageName = 'product-' . $productId . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('customer/img/product'), $imageName);
            // You may want to save $imageName in the database for later use.
        }
    
        // associate the brand with the product
        $product->brands()->attach($request->input('brand'), ['brand_id' => $request->input('brand')]);
    
        // attach categories, sizes, and colors
        $product->categories()->sync($request->input('categories'));
        $product->sizes()->sync($request->input('sizes'));
        $product->colors()->sync($request->input('colors'));
    
        return redirect()->route('admin.products.index')->with('success', 'Product created successfully!');
    }
    


    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product = Product::find($product->id);

        return view('admin.product.show',compact('product'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $categories = Category::all();
        
        return view('admin.product.edit',compact('product','categories'));
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
            'product_category' => 'required|array',
        ]);
    
        $product->update([
            'product_name' => $request->product_name,
            'product_desc' => $request->product_desc,
            'price' => $request->price,
            'size' => $request->size,
        ]);
    
        // Sync the selected categories
        $product->categories()->sync($request->input('product_category'));
    
        return redirect()->route('admin.product.index')->with('success', 'Product updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //$this->deleteProductImages($product);

        // Detach all related records from pivot tables
        $product->brands()->detach();
        $product->categories()->detach();
        $product->colors()->detach();
        $product->sizes()->detach();
        
        // Delete the product
        $product->delete();
    
  
        return redirect()->route('admin.products.index')
                        ->with('success','Product deleted successfully');
    }

    // private function deleteProductImages(Product $product)
    // {
    //     // Construct the image file path based on the product ID
    //     $imageFilePath = public_path('customer/img/product/product-' . $product->id . '.jpg');

    //     // Check if the image exists before attempting to delete it
    //     if (File::exists($imageFilePath)) {
    //         File::delete($imageFilePath);
    //     }
    // }
}
