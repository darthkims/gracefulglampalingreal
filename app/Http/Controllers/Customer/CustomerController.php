<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Concerns\ToArray;

class CustomerController extends Controller
{
    public function edit()
    {
        $users = auth()->user();
        return view('customer.edit', compact('users'));
    }

    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'location' => $request->location,
            'email' => $request->email
        ]);

        return redirect()->route('cust.edit')->with('message', 'Profile updated successfully.');
    }

    // public function changePassword()
    // {
    //     return view('customer.change-password');
    // }

    // public function updatePassword(Request $request)
    // {
    //     $request->validate([
    //         'current_password' => 'required',
    //         'password' => 'required|confirmed',
    //     ]);

    //     $user = User::find(auth()->user()->id);

    //     if (Hash::check($request->current_password, $user->password)) {
    //         $user->password = Hash::make($request->password);
    //         $user->save();

    //         return redirect()->route('customer.change-password')->with('success', 'Password updated successfully.');
    //     } else {
    //         return redirect()->route('customer.change-password')->with('error', 'Current password does not match.');
    //     }
    // }

    // add function view all user order history
    public function orderHistory()
    {
        $user = Auth::user();
        $orders = $user->orders()->get();
        $orders->load('products');
        dd($orders->toArray());

        $orders->each(function ($order) {
            $order->productTotal = $order->products->sum(function ($product) {
                return $product->price * $product->pivot->quantity;
            });

            $order->productTotal = $order->productTotal * 1.1 + 10;
        });

        return view('customer.order-history', compact('orders'));
    }

    public function download($orderId) {

        $user = Auth::user();
        $orders = Order::findOrFail($orderId);
        $orders->load('products');

        $data = [];
        $totalPrice = 0;

        // Loop through products in the order
        foreach ($orders->products as $product) {
            $itemPrice = $product->pivot->quantity * $product->price;
    
            $data[] = [
                'quantity' => $product->pivot->quantity,
                'description' => $product->name,
                'price' => $product->price,
                'total_item_price' => $itemPrice,
            ];
    
            $totalPrice += $itemPrice;
            
        }

        $totalPrice=$totalPrice*1.1+10;
        
            // Include user details in the data array
            $userData = [
                'name' => $user->name,
                'address' => $user->location,
            ];

     
        $pdf = Pdf::loadView('customer.pdf', ['data' => $data, 'orders' => $orders, 'totalPrice' => $totalPrice, 'userData' => $userData]);
     
        return $pdf->download();
    }

    public function deleteOrder(Request $request, $orderId)
    {
        // Find the order by ID
        $order = Order::findOrFail($orderId);

        // Check if the authenticated user is the owner of the order
        if ($order->user_id !== auth()->user()->id) {
            return response()->json(['message' => 'Unauthorized'], 403);
        }

        // Delete the order and its associated products using the relationships
        $order->products()->detach(); // Detach products from the pivot table
        $order->delete(); // Delete the order

        return redirect()->route('cust.orders')->with('success','Order cancelled successfully');    }

}
