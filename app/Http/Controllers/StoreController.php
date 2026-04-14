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

        // ── Full-text search (name + descriptions) ────────────────────────
        if ($request->filled('q')) {
            $term = '%' . $request->input('q') . '%';
            $query->where(function ($q) use ($term) {
                $q->where('name', 'LIKE', $term)
                  ->orWhere('short_description', 'LIKE', $term)
                  ->orWhere('description', 'LIKE', $term);
            });
        }

        // ── Filament filter ───────────────────────────────────────────────
        if ($request->filled('filament')) {
            $query->whereIn('filament', $request->input('filament'));
        }

        // ── Colour filter ─────────────────────────────────────────────────
        if ($request->filled('colour')) {
            $query->whereIn('colour', $request->input('colour'));
        }

        // ── File format filter (field stores values like "STL, 3MF") ──────
        if ($request->filled('format')) {
            $query->where(function ($q) use ($request) {
                foreach ($request->input('format') as $fmt) {
                    $q->orWhere('file_format', 'LIKE', '%' . $fmt . '%');
                }
            });
        }

        // ── Price range ───────────────────────────────────────────────────
        if ($request->filled('min_price')) {
            $query->where('price', '>=', (float) $request->input('min_price'));
        }

        if ($request->filled('max_price')) {
            $query->where('price', '<=', (float) $request->input('max_price'));
        }

        // ── Sorting ───────────────────────────────────────────────────────
        match ($request->input('sort')) {
            'price_asc'  => $query->orderBy('price', 'asc'),
            'price_desc' => $query->orderBy('price', 'desc'),
            'newest'     => $query->orderBy('created_at', 'desc'),
            default      => $query->orderBy('id', 'asc'),
        };

        // ── Paginate — withQueryString keeps all params in page links ──────
        $products = $query->paginate(12)->withQueryString();

        // ── Slider bounds ─────────────────────────────────────────────────
        $priceMin = (int) Product::min('price');
        $priceMax = (int) Product::max('price');

        // ── Colour list built from DB so it stays in sync with seeder ─────
        $availableColours = Product::select('colour')
            ->distinct()
            ->orderBy('colour')
            ->pluck('colour');

        return view('store', compact(
            'products',
            'priceMin',
            'priceMax',
            'availableColours'
        ));
    }
}