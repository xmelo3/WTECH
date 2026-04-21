<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts  = Product::count();
        $avgPrice       = Product::avg('price') ?? 0;
        $totalPieces    = Product::sum('pieces') ?? 0;
        $recentProducts = Product::latest()->take(8)->get();

        return view('admin.dashboard', compact(
            'totalProducts', 'avgPrice', 'totalPieces', 'recentProducts'
        ));
    }
}