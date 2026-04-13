<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class StoreController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::query();

        if ($request->filled('filament')) {
            $query->whereIn('filament', $request->input('filament'));
        }

        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->input('max_price'));
        }

        match ($request->input('sort')) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'newest'     => $query->orderBy('created_at', 'desc'),
            default      => $query->orderBy('id', 'asc'),
        };

        $products = $query->paginate(12)->withQueryString();

        // ↓ these two lines are what was missing
        $priceMin = (int) Product::min('price');
        $priceMax = (int) Product::max('price');

        return view('store', compact('products', 'priceMin', 'priceMax'));
}
}