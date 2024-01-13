<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class UserController extends Controller
{
    public function index ()
    {
        $users = User::with('roles')->orderBy('created_at', 'desc')->get();

        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();

        return view('admin.user.create', compact('roles'));
    }

    public function store(Request $request)
    {
        //check for name uniqe
        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:8',
            'role' => 'required',
        ]);

        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => strtolower($request->email),
            'password' => $request->password,
            'phone' => $request->phone,
            'location' => $request->location,
        ])->assignRole($request->role);

        return Redirect::route('users.index')->with('message', 'User has been created');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        $roles = Role::all();

        return view('admin.user.edit', compact('user', 'roles'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // validate form
        $request->validate([
            'name' => 'required|max:100',
            'username' => 'required|unique:users,username,' . $user->id,
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8',
            'role' => 'required',
        ]);

        // update user
        $user->update([
            'name' => $request->name,
            'username' => $request->username,
            'email' => strtolower($request->email),
            'phone' => $request->phone,
            'location' => $request->location,
        ]);

        // update password if entered
        if ($request->filled('password')) {
            $user->update(['password' => $request->password]);
        }

        // sync roles
        $user->syncRoles([$request->role]);

        return Redirect::route('users.index')->with('message', 'User has been updated');
    }

    public function destroy($id)
    {
        User::destroy($id);

        return Redirect::route('users.index')->with('message', 'User has been deleted');
    }
}
