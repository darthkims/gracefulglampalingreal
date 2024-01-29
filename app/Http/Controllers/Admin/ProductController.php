<?php

namespace App\Http\Controllers\Admin;

use File;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\Location;
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
        $locations = Location::all();
    
        return view('admin.product.create', compact('categories', 'sizes', 'colors', 'brands', 'locations'));
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
            'product_image' => 'image|mimes:jpg|max:5120|dimensions:min_width=1,min_height=1',
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
            $image->move(public_path('storage'), $imageName);
            $product = Product::find($productId);
            $product->productimg = $imageName;
            $product->save();
<<<<<<< HEAD
            // You may want to save $imageName in the database for later use.
        }
=======

        }
        
        // Upload and save thumbnails
        for ($i = 1; $i <= 4; $i++) {
            $thumbnailImage = $request->file('thumbnail_' . $i);
        
            // Check if the file exists
            if ($thumbnailImage) {
                $thumbnailName = 'thumb-' . $i . '-' . $productId . '.' . $thumbnailImage->getClientOriginalExtension();
                $thumbnailImage->move(public_path('storage'), $thumbnailName);
            
                // Save thumbnail information in the database
                $product = Product::find($productId);
                $product->{"productthumb" . $i}= $thumbnailName;
                $product->save();
            }
        }        
>>>>>>> parent of 75c7507 (Update ProductController.php)
    
        // associate the brand with the product
        $product->brands()->attach($request->input('brand'), ['brand_id' => $request->input('brand')]);
    
        // attach categories, sizes, and colors, locations
        $product->locations()->sync($request->input('locations'));
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
        return view('admin.product.show',compact('product'));
    }
    

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {

        $categories = Category::all();
        $brands = Brand::all();
        $sizes = Size::all();
        $colors = Color::all();
        $locations = Location::all();
        
        return view('admin.product.edit',compact('product','categories','brands','sizes','colors', 'locations'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required',
        ]);
    
        // Update the product details
        $product->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'price' => $request->input('price'),
        ]);
    
        // Update the brand association
        $product->brands()->sync([$request->input('brand')]);
    
        // Update the categories, sizes, and colors associations
        $product->categories()->sync($request->input('categories'));
        $product->sizes()->sync($request->input('sizes'));
        $product->colors()->sync($request->input('colors'));
        $product->locations()->sync($request->input('locations'));
    
        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully');
    }

    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $this->deleteProductImages($product);

        // Detach all related records from pivot tables
        $product->brands()->detach();
        $product->categories()->detach();
        $product->colors()->detach();
        $product->sizes()->detach();
        $product->locations()->detach();
        
        // Delete the product
        $product->delete();

        return redirect()->route('admin.products.index')->with('success','Product deleted successfully');
    }

    private function deleteProductImages(Product $product)
    {
        // Construct the image file path based on the product ID
        $imageFilePath = public_path('storage/product-' . $product->id . '.jpg');

        // Check if the image exists before attempting to delete it
        if (File::exists($imageFilePath)) {
            File::delete($imageFilePath);
        }
    }
}
