<?php
 
namespace App\Http\Controllers;
 
use App\Models\Product;
 
class HomeController extends Controller
{
    public function index()
    {
        // Pick 8 products for the featured scroll — newest first
        $featuredProducts = Product::latest()->take(8)->get();
 
        return view('index', compact('featuredProducts'));
    }
}
 