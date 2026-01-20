<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    /**
     * Display the user's orders page.
     */
    public function index(Request $request)
    {
        return view('pages.orders');
    }

    /**
     * Get the user's orders as JSON.
     */
    public function getOrders(Request $request): JsonResponse
    {
        $userId = $request->attributes->get('auth_user_id');

        if (!$userId) {
            return response()->json([
                'success' => false,
                'message' => 'Please log in to view your orders',
                'orders' => [],
            ], 401);
        }

        $orders = Order::where('user_id', $userId)
            ->with('items')
            ->orderBy('created_at', 'desc')
            ->get()
            ->map(function ($order) {
                return [
                    'id' => $order->id,
                    'order_number' => $order->order_number,
                    'status' => $order->status,
                    'status_label' => Order::statuses()[$order->status] ?? ucfirst($order->status),
                    'subtotal' => $order->subtotal,
                    'tax' => $order->tax,
                    'shipping' => $order->shipping,
                    'total' => $order->total,
                    'customer_name' => $order->customer_name,
                    'shipping_address' => $this->formatAddress($order),
                    'items' => $order->items->map(function ($item) {
                        return [
                            'id' => $item->id,
                            'product_id' => $item->product_id,
                            'product_name' => $item->product_name,
                            'product_price' => $item->product_price,
                            'quantity' => $item->quantity,
                            'total' => $item->total,
                        ];
                    }),
                    'items_count' => $order->items->count(),
                    'created_at' => $order->created_at->toISOString(),
                    'created_at_formatted' => $order->created_at->format('M d, Y'),
                ];
            });

        return response()->json([
            'success' => true,
            'orders' => $orders,
        ]);
    }

    /**
     * Format the shipping address.
     */
    private function formatAddress(Order $order): string
    {
        $parts = array_filter([
            $order->shipping_address1,
            $order->shipping_address2,
            $order->shipping_city,
            $order->shipping_state,
            $order->shipping_zip,
            $order->shipping_country,
        ]);

        return implode(', ', $parts);
    }
}
