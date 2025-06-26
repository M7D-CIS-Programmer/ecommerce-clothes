<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        if ($products->isEmpty()) {
            return response()->json(['message' => 'No products found'], 404);
        } else {
            return response()->json($products, 200);
        }
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'nullable|string',
            'img' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'All fields are required',
                'errors' => $validator->errors()
            ]);
        } else {
            $product = Product::create([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'img' => $request->img,
            ]);
            return response()->json([
                'message' => 'Product created successfully',
                'product' => new ProductResource($product)
            ], 201);
        }
    }

    public function show($id) {
        
        $product = Product::find($id);
        if ($product) {
            return response()->json($product, 200);
        } else {
            return response()->json(['message' => 'Product not found'], 404);
        }
    }

    public function update(Product $product, Request $request) {
        
        $validator = Validator::make($request->all(),[
            'name' => 'required|string|max:255',
            'price' => 'required|integer',
            'description' => 'nullable|midumtext',
            'img' => 'nullable|string',
        ]);

        if($validator->fails()) {
            return response()->json([
                'message' => 'All fields are required',
                'errors' => $validator->errors()
            ]);
        } else {
            $product->update([
                'name' => $request->name,
                'price' => $request->price,
                'description' => $request->description,
                'img' => $request->img,
            ]);
            return response()->json([
                'message' => 'Product updated successfully',
                'product' => new ProductResource($product)
            ], 200);
        }
    }

    public function destroy(Product $product) {
        $product->delete();
        return response()->json([
            'message' => 'Product deleted successfully'
        ]);
    }
}
