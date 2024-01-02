<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class RoleController extends Controller
{
    public function index ()
    {
        $roles = Role::orderBy('created_at', 'desc')->get();

        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        return view('admin.role.create');
    }

    public function store(Request $request)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        Role::create([
            'name' => $request->name,
        ]);

        return Redirect::route('roles.index')->with('message', 'Role has been created');
    }

    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.role.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|unique:roles',
        ]);

        Role::where('id', $id)->update([
            'name' => $request->name,
        ]);

        return Redirect::route('roles.index')->with('message', 'Role has been updated');
    }

    public function destroy($id)
    {
        // Student::where('student_id', $id)->delete();
        Role::destroy($id);

        return Redirect::route('roles.index')->with('message', 'Role has been deleted');
    }
}
