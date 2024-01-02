<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class BrandController extends Controller
{
    public function index ()
    {
        $brands = Brand::orderBy('created_at', 'desc')->get();

        return view('admin.brand.index', compact('brands'));
    }

    public function create()
    {
        return view('admin.brand.create');
    }

    public function store(Request $request)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:brands',
        ]);

        Brand::create([
            'name' => $request->name,
        ]);

        return Redirect::route('brands.index')->with('message', 'Brand has been created');
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        return view('admin.brand.edit', compact('brand'));
    }

    public function update(Request $request, $id)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:brands',
        ]);

        Brand::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return Redirect::route('brands.index')->with('message', 'Brand has been updated');
    }

    public function destroy($id)
    {
        // Student::where('student_id', $id)->delete();
        Brand::destroy($id);

        return Redirect::route('brands.index')->with('message', 'Brand has been deleted');
    }
}
