<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    // GET /customers
    public function index()
    {
        $customers = Customer::all();

        return response()->json([
            'success' => true,
            'data' => $customers
        ], 200);
    }

    // POST /customers
    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email|unique:customers',
            'phone'   => 'required',
            'address' => 'required',
        ]);

        $customer = Customer::create($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Customer berhasil ditambahkan',
            'data' => $customer
        ], 201);
    }

    // GET /customers/{id}
    public function show($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer tidak ditemukan'
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data' => $customer
        ], 200);
    }

    // PUT /customers/{id}
    public function update(Request $request, $id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer tidak ditemukan'
            ], 404);
        }

        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email|unique:customers,email,' . $id,
            'phone'   => 'required',
            'address' => 'required',
        ]);

        $customer->update($request->all());

        return response()->json([
            'success' => true,
            'message' => 'Customer berhasil diperbarui',
            'data' => $customer
        ], 200);
    }

    // DELETE /customers/{id}
    public function destroy($id)
    {
        $customer = Customer::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer tidak ditemukan'
            ], 404);
        }

        $customer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Customer berhasil dihapus'
        ], 200);
    }
}
