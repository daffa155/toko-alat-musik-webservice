<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        return response()->json([
            'status' => 'success',
            'data' => Category::all()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required']);

        $category = Category::create($request->all());

        return response()->json([
            'status' => 'success',
            'data' => $category
        ], 201);
    }
}
