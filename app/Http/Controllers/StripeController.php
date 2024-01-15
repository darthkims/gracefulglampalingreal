<?php 
 
namespace App\Http\Controllers;
 
use Stripe\Stripe;
use App\Models\Order;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
 
class StripeController extends Controller
{
    public function checkout()
    {
        return redirect()->route('checkout');
    }
 
    public function session(Request $request)
    {
        Stripe::setApiKey(config('stripe.sk'));
        
        $orderId = $request->orderId;
        $total = $request->total;
        $order = Order::with('products')->where('id', $orderId)->first();

        $lineItems = [];

        foreach ($order->products as $product) {
            // Add each product as a line item
            $lineItems[] = [
                'price_data' => [
                    'currency'     => 'myr',
                    'product_data' => [
                        "name" => $product['name'],
                    ],
                    'unit_amount'  => $product['price'] * 100, // Stripe requires amount in cents
                ],
                'quantity'   => $product->pivot->quantity,
            ];
        }

        // Create a Stripe checkout session
        $session = Session::create([
            'line_items'  => $lineItems,
            'mode'        => 'payment',
            'success_url' => route('success', ['order_id' => $orderId]),
            'cancel_url'  => route('checkout', ['order_id' => $orderId]),
        ]);

        return redirect()->away($session->url);
    }
 
    public function success(Request $request)
    {
        $order_id = $request->order_id;

        // Retrieve the order
        $order = Order::find($order_id);

        // Check if the order exists and update its status
        if ($order) {
            $order->update(['status' => 'completed']);
        }

        return redirect()->route('cust.orders');
    }
}