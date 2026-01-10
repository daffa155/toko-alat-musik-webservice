<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\ActivityLog;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Product::with('category')->get()
        ], 200);
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string',
        'description' => 'required|string',
        'price' => 'required|integer',
        'stock' => 'required|integer',
        'category_id' => 'required|exists:categories,id'
    ]);

    // 1. Simpan product dulu
    $product = Product::create($validated);

    // 2. Simpan log aktivitas
    ActivityLog::create([
        'user_id' => auth('api')->id(), // dari JWT
        'activity' => 'Create Product',
        'endpoint' => '/api/products',
        'method' => 'POST',
        'ip_address' => $request->ip()
    ]);

    return response()->json([
        'status' => 'success',
        'data' => $product
    ], 201);
}

    public function show($id)
    {
        return response()->json([
            'status' => 'success',
            'data' => Product::with('category')->findOrFail($id)
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        // LOG AKTIVITAS
        ActivityLog::create([
            'user_id' => auth('api')->id(),
            'activity' => 'Update Product',
            'endpoint' => '/api/products/' . $id,
            'method' => 'PUT',
            'ip_address' => $request->ip()
        ]);

        return response()->json([
            'status' => 'success',
            'data' => $product
        ], 200);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        // LOG AKTIVITAS
        ActivityLog::create([
            'user_id' => auth('api')->id(),
            'activity' => 'Delete Product',
            'endpoint' => '/api/products/' . $id,
            'method' => 'DELETE',
            'ip_address' => request()->ip()
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted'
        ], 200);
    }
}
