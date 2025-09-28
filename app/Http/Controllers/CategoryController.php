<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function create()
    {
         $categories = Category::all(); // Get all categories
    return view('admin.products.create', compact('categories'));
    }
}
