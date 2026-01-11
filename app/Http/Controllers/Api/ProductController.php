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
    $request->validate([
        'name'        => 'required',
        'price'       => 'required|numeric',
        'stock'       => 'required|numeric',
        'category_id' => 'required|exists:categories,id',
        'image'       => 'nullable|image|mimes:jpg,jpeg,png'
    ]);

    $imagePath = null;

    // TEMPAT SIMPAN FOTO
    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('products', 'public');
    }

    $product = Product::create([
        'name'        => $request->name,
        'price'       => $request->price,
        'stock'       => $request->stock,
        'category_id' => $request->category_id,
        'image'       => $imagePath
    ]);

    return response()->json([
        'message' => 'Produk berhasil ditambahkan',
        'data'    => $product
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
