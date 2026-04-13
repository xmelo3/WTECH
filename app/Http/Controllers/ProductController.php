<?php

namespace App\Http\Controllers;

use App\Models\Product;

class ProductController extends Controller
{
    public function show(Product $product)
    {
        return view('detail', compact('product'));
    }

    public function index()
    {
        $products = Product::with('user')->paginate(20);
        return view('store', compact('products'));
    }
}