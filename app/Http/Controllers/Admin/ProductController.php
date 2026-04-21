<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::latest();
        if ($request->filled('q')) {
            $query->where('name', 'like', '%' . $request->q . '%');
        }
        $products = $query->paginate(20)->withQueryString();
        return view('admin.products.index', compact('products'));
    }

    public function create()
    {
        return view('admin.products.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')
                ->store('products', 'public');
        }
        $validated['user_id'] = auth()->id();

        $product = Product::create($validated);

        return redirect()->route('admin.products.index')
            ->with('success', "Product \"{$product->name}\" created.");
    }

    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request);

        if ($request->hasFile('main_image')) {
            if ($product->main_image && str_starts_with($product->main_image, 'products/')) {
                Storage::disk('public')->delete($product->main_image);
            }
            $validated['main_image'] = $request->file('main_image')
                ->store('products', 'public');
        }

        $product->update($validated);

        return redirect()->route('admin.products.index')
            ->with('success', "Product \"{$product->name}\" updated.");
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        if ($product->main_image && str_starts_with($product->main_image, 'products/')) {
            Storage::disk('public')->delete($product->main_image);
        }
        $product->delete();

        return redirect()->route('admin.products.index')
            ->with('success', "Product \"{$name}\" deleted.");
    }

    private function validateProduct(Request $request): array
    {
        return $request->validate([
            'name'              => 'required|string|max:255',
            'price'             => 'required|numeric|min:0',
            'short_description' => 'nullable|string|max:500',
            'description'       => 'nullable|string',
            'filament'          => 'nullable|string|max:100',
            'colour'            => 'nullable|string|max:100',
            'pieces'            => 'nullable|integer|min:1',
            'print_time'        => 'nullable|string|max:50',
            'supports'          => 'nullable|string|in:No,Yes,Optional',
            'infill'            => 'nullable|string|max:50',
            'layer_height'      => 'nullable|string|max:50',
            'file_format'       => 'nullable|string|max:100',
            'license'           => 'nullable|string|max:100',
            'main_image'        => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);
    }
}