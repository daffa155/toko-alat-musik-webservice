<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Customer;

class OrderController extends Controller
{
    // GET /orders
    public function index()
    {
        $orders = Order::with('customer')->get();

        return response()->json([
            'success' => true,
            'data' => $orders
        ], 200);
    }

    // POST /orders
    public function store(Request $request)
    {
        $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'total_price' => 'required|numeric',
            'status' => 'nullable|string',
        ]);

        $order = Order::create([
            'customer_id' => $request->customer_id,
            'total_price' => $request->total_price,
            'status' => $request->status ?? 'pending',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dibuat',
            'data' => $order
        ], 201);
    }

    // GET /orders/{id}
    public function show($id)
    {
        $order = Order::with('customer')->find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $order
        ], 200);
    }

    // PUT /orders/{id}
    public function update(Request $request, $id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'total_price' => 'required|numeric',
            'status' => 'required|string',
        ]);

        $order->update($request->only('total_price', 'status'));

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil diperbarui',
            'data' => $order
        ], 200);
    }

    // DELETE /orders/{id}
    public function destroy($id)
    {
        $order = Order::find($id);

        if (!$order) {
            return response()->json([
                'success' => false,
                'message' => 'Order tidak ditemukan'
            ], 404);
        }

        $order->delete();

        return response()->json([
            'success' => true,
            'message' => 'Order berhasil dihapus'
        ], 200);
    }
}
