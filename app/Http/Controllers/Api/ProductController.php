<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Product::with('category')->get()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
    'name' => 'required',
    'description' => 'required',
    'price' => 'required|integer',
    'stock' => 'required|integer',
    'category_id' => 'required|exists:categories,id'
]);


        $product = Product::create($request->all());

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
        ]);
    }

    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);

        $product->update($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $product
        ]);
    }

    public function destroy($id)
    {
        Product::findOrFail($id)->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Product deleted'
        ]);
    }
}
