<?php

namespace App\Exports;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportOrder implements FromCollection, WithHeadings
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Corrected the variable name to $orders
        $orders = Order::with(['user' => function ($query) {
            $query->select('id', 'name', 'username');
        }])
        ->with(['products' => function ($query) {
            $query->select('products.id', 'products.name'); // Explicitly select columns with table alias
        }])
        ->select('orders.order_number', 'orders.total', 'orders.user_id', 'orders.id')
        ->where('status', 'completed') //only get completed orders
        ->get()
        ->map(function ($order) {
            $name = optional($order->user)->name;
    
            $productDetails = $order->products->map(function ($product) {
                return $product->name . ' (' . $product->pivot->quantity . ')';
            })->implode(', ');
    
            return collect([
                'order_number' => $order->order_number,
                'name' => $name,
                'products' => $productDetails,
                'total' => $order->total,
            ]);
        });

        $allOrders = Order::with(['user', 'products',])->where('status', 'completed')->get();

        // Analyze data
        $analytics = $this->analyzeOrders($allOrders);

        // // Transform the analytics array for new table rows
        // $analyticsRows = collect();
        // foreach ($analytics as $key => $value) {
        //     $analyticsRows->push(['Analytics' => $key, 'Value' => $value]);
        // }

        // return $orders->merge([$analyticsRows]);

        $analyticsRows = collect();
        foreach ($analytics as $key => $value) {
            $analyticsRows->push(['Analytics' => $key, 'Value' => $value]);
        }
    
        // Insert a gap row
        $gapRow = ['Order No.' => null, 'Username' => null, 'Product' => null, 'Total' => null];
        $ordersAndGap = $orders->concat([$gapRow])->concat($analyticsRows);
    
        return $ordersAndGap;
    }

    public function headings(): array
    {
        // Updated the column headings for the Excel file
        return ['Order No.', 'Username', 'Product', 'Total'];
    }

    private function analyzeOrders(Collection $orders): array
    {
        $totalOrders = $orders->count();

        $productQuantities = [];

        // Iterate through orders
        foreach ($orders as $order) {
            // Iterate through products in each order
            foreach ($order['products'] as $product) {
                $productId = $product['id'];

                // Accumulate quantities for each product
                if (!isset($productQuantities[$productId])) {
                    $productQuantities[$productId] = 0;
                }

                $productQuantities[$productId] += $product['pivot']['quantity'];
            }
        }

        // Find the most purchased and least purchased products
        $mostPurchasedProductId = array_search(max($productQuantities), $productQuantities);
        $leastPurchasedProductId = array_search(min($productQuantities), $productQuantities);

        $bestSeller = Product::where('id', $mostPurchasedProductId)->pluck('name')->first();
        $leastOrderedItem =  Product::where('id', $leastPurchasedProductId)->pluck('name')->first();

        return [
            'Total Order' => $totalOrders,
            'Best Seller' => $bestSeller,
            'Least Ordered Item' => $leastOrderedItem,
        ];
    }
}
