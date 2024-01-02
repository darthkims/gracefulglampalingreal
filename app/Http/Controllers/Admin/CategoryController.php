<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{
    public function index ()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();

        return view('admin.category.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.category.create');
    }

    public function store(Request $request)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return Redirect::route('categories.index')->with('message', 'Category has been created');
    }

    public function edit($id)
    {
        $category = Category::findOrFail($id);

        return view('admin.category.edit', compact('category'));
    }

    public function update(Request $request, $id)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:categories',
        ]);

        Category::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return Redirect::route('categories.index')->with('message', 'Category has been updated');
    }

    public function destroy($id)
    {
        // Student::where('student_id', $id)->delete();
        Category::destroy($id);

        return Redirect::route('categories.index')->with('message', 'Category has been deleted');
    }
}
