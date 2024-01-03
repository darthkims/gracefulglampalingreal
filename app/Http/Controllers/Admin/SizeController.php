<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class SizeController extends Controller
{
    public function index ()
    {
        $sizes = Size::orderBy('created_at', 'desc')->get();

        return view('admin.sizes.index', compact('sizes'));
    }

    public function create()
    {
        return view('admin.sizes.create');
    }

    public function store(Request $request)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:sizes',
        ]);

        Size::create([
            'name' => $request->name,
        ]);

        return Redirect::route('sizes.index')->with('message', 'Size has been created');
    }

    public function edit($id)
    {
        $size = Size::findOrFail($id);

        return view('admin.sizes.edit', compact('size'));
    }

    public function update(Request $request, $id)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:colors',
        ]);

        Size::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return Redirect::route('sizes.index')->with('message', 'Size has been updated');
    }

    public function destroy($id)
    {
        // Student::where('student_id', $id)->delete();
        Size::destroy($id);

        return Redirect::route('sizes.index')->with('message', 'Color has been deleted');
    }
}
