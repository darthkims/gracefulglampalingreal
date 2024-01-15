<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class CustomerController extends Controller
{
    public function edit()
    {
        $users = auth()->user();

        return view('customer.edit', compact('users'));
    }
}
