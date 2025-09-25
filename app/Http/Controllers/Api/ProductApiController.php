<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::latest()->get();
        return response()->json([
            'status' => true,
            'data' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
        ]);


        $data = $request->only(['name', 'description', 'price']);

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('products', 'public');
            $data['image'] = $imagePath;
        }

        $product = Product::create($data);

        return response()->json([
            'status' => true,
            'message' => 'Product created successfully',
            'data' => $product
        ],201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return response()->json([
            'status' => true,
            'data' => $product
        ]);
    }   
 
    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Product $product)
    {
        $request->validate([
            'name'  => 'required',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048'
        ]);

        $data = $request->only(['name','description','price']);

        if ($request->hasFile('image')) {
            if ($product->image && file_exists(storage_path('app/public/'.$product->image))) {
                unlink(storage_path('app/public/'.$product->image));
            }
            $data['image'] = $request->file('image')->store('products','public');
        }

        $product->update($data);

        return response()->json([
            'status' => true,
            'message'=> 'Product updated successfully',
            'data'   => $product
        ]);
    }

    public function destroy(Product $product)
    {
        if ($product->image && file_exists(storage_path('app/public/'.$product->image))) {
            unlink(storage_path('app/public/'.$product->image));
        }

        $product->delete();

        return response()->json([
            'status' => true,
            'message'=> 'Product deleted successfully'
        ]);
    }
}
