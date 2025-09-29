<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class UserProductController extends Controller
{
    public function index()
    {
        $categories = Category::all(); // Changed to simple all() if you don't need products eager loaded
        return view('user.products.index', compact('categories'));
    }

    public function show(Product $product)
    {
        return view('user.products.show', compact('product'));
    }
 
    public function getByCategory(Request $request)
{
    try {
        \Log::info('getByCategory called', ['request' => $request->all()]);

        if (!$request->has('category_id') || empty($request->category_id)) {
            return response('<p class="text-red-500">Please select a category</p>');
        }

        $products = Product::where('category_id', $request->category_id)->get();
        
        \Log::info('Products retrieved', [
            'category_id' => $request->category_id,
            'count' => $products->count()
        ]);

        // Check if view exists
        if (!view()->exists('user.products._products')) {
            \Log::error('View not found: user.products._products');
            return response('<p class="text-red-500">View file not found</p>');
        }

        return view('user.products._products', compact('products'));
        
    } catch (\Exception $e) {
        \Log::error('Error in getByCategory: ' . $e->getMessage());
        return response('<p class="text-red-500">Server error: ' . $e->getMessage() . '</p>');
    }
}
    public function buy($id)
    {
        $product = Product::findOrFail($id);
        return view('user.products.buy', compact('product'));
    }
}