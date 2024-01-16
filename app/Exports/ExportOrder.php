<?php

namespace App\Exports;

use App\Models\Order;
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

        // Analyze data
        $analytics = $this->analyzeOrders($orders);

        // Transform the analytics array for new table rows
        $analyticsRows = collect();
        foreach ($analytics as $key => $value) {
            $analyticsRows->push(['Analytics' => $key, 'Value' => $value]);
        }

        return $orders->merge([$analyticsRows]);
    }

    public function headings(): array
    {
        // Updated the column headings for the Excel file
        return ['Order No.', 'Username', 'Product', 'Total'];
    }

    private function analyzeOrders(Collection $orders): array
    {
        $totalOrders = $orders->count();
        $productCounts = $orders->flatMap(function ($order) {
            return $order['products'];
        })->countBy();

        // Best seller
        $bestSeller = $productCounts->sortDesc()->keys()->first();

        // Least ordered item
        $leastOrderedItem = $productCounts->sort()->keys()->first();

        return [
            'Total Order' => $totalOrders,
            'Best Seller' => $bestSeller,
            'Least Ordered Item' => $leastOrderedItem,
        ];
    }
}
