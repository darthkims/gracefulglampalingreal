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

    // Calculate the total amount without tax
    $subtotal = 0;

    foreach ($order->products as $product) {
        $subtotal += $product->price * $product->pivot->quantity;
    }

    // Calculate tax amount (replace 0.1 with your actual tax rate)
    $taxRate = 0.1;
    $taxAmount = round($subtotal * $taxRate, 2);

    // Calculate the total amount including tax
    $totalWithTax = $subtotal + $taxAmount;

    $shipping_options = [];

    $shipping_options = [
        [
        'shipping_rate_data' => [
          'type' => 'fixed_amount',
          'fixed_amount' => [
            'amount' => 1000,
            'currency' => 'myr',
          ],
          'display_name' => 'Normal postage',
          'delivery_estimate' => [
            'minimum' => [
              'unit' => 'business_day',
              'value' => 1,
            ],
            'maximum' => [
              'unit' => 'business_day',
              'value' => 5,
            ],
          ],
        ],
      ],
    ];

    // Create an array of line items
    $lineItems = [];

    foreach ($order->products as $product) {
        $lineItems[] = [
            'price_data' => [
                'currency'     => 'myr',
                'product_data' => [
                    'name' => $product->name,
                ],
                'unit_amount'  => $product->price * 100, // Amount in cents
            ],
            'quantity'   => $product->pivot->quantity,
        ];
    }

    // Add a line item for tax
    $lineItems[] = [
        'price_data' => [
            'currency'     => 'myr',
            'product_data' => [
                'name' => 'Service Fee 10%',
            ],
            'unit_amount'  => $taxAmount * 100, // Amount in cents
        ],
        'quantity'   => 1,
    ];

        // Create a Stripe checkout session
        $session = Session::create([
            'line_items'  => $lineItems,
            'shipping_options' => $shipping_options,
            'mode'        => 'payment',
            'success_url' => route('success', ['order_id' => $orderId]),
            'cancel_url'  => route('checkout.redirect', ['orderId' => $orderId]),
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
            $order->update([
                'status' => 'completed',
                'order_status' => 'To Ship',
            ]);
        }

        return redirect()->route('cust.orders')->with('success', 'Payment successful :)');
    }
}