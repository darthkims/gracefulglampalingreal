<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class ColorController extends Controller
{
    public function index ()
    {
        $colors = Color::orderBy('created_at', 'desc')->get();

        return view('admin.color.index', compact('colors'));
    }

    public function create()
    {
        return view('admin.color.create');
    }

    public function store(Request $request)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:colors',
        ]);

        Color::create([
            'name' => $request->name,
        ]);

        return Redirect::route('colors.index')->with('message', 'Color has been created');
    }

    public function edit($id)
    {
        $color = Color::findOrFail($id);

        return view('admin.color.edit', compact('color'));
    }

    public function update(Request $request, $id)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:colors',
        ]);

        Color::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return Redirect::route('colors.index')->with('message', 'Color has been updated');
    }

    public function destroy($id)
    {
        // Student::where('student_id', $id)->delete();
        Color::destroy($id);

        return Redirect::route('colors.index')->with('message', 'Color has been deleted');
    }
}
