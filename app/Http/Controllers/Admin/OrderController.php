<?php

namespace App\Http\Controllers\Admin;

use App\Exports\ExportOrder;
use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index ()
    {
        $carts = Order::orderBy('created_at', 'asc')->get();
        

        return view('admin.cart.index', compact('carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Order $order)
    {
    
        return view('admin.cart.show', compact('order'));
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Student::where('student_id', $id)->delete();
        Cart::destroy($id);

        //return Redirect::route('carts.index')->with('message', 'Cart has been deleted');
    }

    public function exportOrders(Request $request){
        return Excel::download(new ExportOrder, 'orders.xlsx');
    }

    
}
