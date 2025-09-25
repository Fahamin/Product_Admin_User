<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class UserProductController extends Controller
{
    
    public function index()
    {
      $products = Product::latest()->paginate(5);
    return view('user.products.index', compact('products'));
    }

    public function show(Product $product)
    {
     
        return view('user.products.show', compact('product'));
    }
}
