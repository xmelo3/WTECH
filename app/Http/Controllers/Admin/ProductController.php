<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\ProductImage;

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
        $validated = $this->validateProduct($request, isCreate: true);
        $this->validateExtraImages($request, required: true);

        if ($request->hasFile('main_image')) {
            $validated['main_image'] = $request->file('main_image')->store('products', 'public');
        }
        $validated['user_id'] = auth()->id();
        $product = Product::create($validated);

        $this->saveExtraImages($request, $product);

        return redirect()->route('admin.products.index')
            ->with('success', "Product \"{$product->name}\" created.");
    }


    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }


    public function update(Request $request, Product $product)
    {
        $validated = $this->validateProduct($request, isCreate: false);
        $this->validateExtraImages($request, required: false);

        $deleteIds  = (array) $request->input('delete_images', []);
        $remaining  = $product->images()->whereNotIn('id', $deleteIds)->count();
        $newCount   = $request->hasFile('images') ? count($request->file('images')) : 0;

        if ($remaining + $newCount < 1) {
            return back()
                ->withErrors(['images' => 'Product must keep at least one additional image.'])
                ->withInput();
        }

        if ($request->hasFile('main_image')) {
            if ($product->main_image && str_starts_with($product->main_image, 'products/')) {
                Storage::disk('public')->delete($product->main_image);
            }
            $validated['main_image'] = $request->file('main_image')->store('products', 'public');
        }
        $product->update($validated);

        // delete checked images (physical file)
        foreach ($deleteIds as $imgId) {
            $img = ProductImage::where('product_id', $product->id)->find($imgId);
            if ($img) {
                Storage::disk('public')->delete($img->path);
                $img->delete();
            }
        }
        $this->saveExtraImages($request, $product);

        return redirect()->route('admin.products.index')
            ->with('success', "Product \"{$product->name}\" updated.");
    }

    public function destroy(Product $product)
    {
        $name = $product->name;
        foreach ($product->images as $img) {
            Storage::disk('public')->delete($img->path);
        }
        if ($product->main_image && str_starts_with($product->main_image, 'products/')) {
            Storage::disk('public')->delete($product->main_image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')
            ->with('success', "Product \"{$name}\" deleted.");
    }

    private function validateProduct(Request $request, bool $isCreate = true): array
    {
        return $request->validate([
            'name'              => 'required|string|max:255',
            'price'             => 'required|numeric|min:0',
            'description'       => 'required|string',
            'short_description' => 'nullable|string|max:500',
            'filament'          => 'nullable|string|max:100',
            'colour'            => 'nullable|string|max:100',
            'pieces'            => 'nullable|integer|min:1',
            'print_time'        => 'nullable|string|max:50',
            'supports'          => 'nullable|string|in:No,Yes,Optional',
            'infill'            => 'nullable|string|max:50',
            'layer_height'      => 'nullable|string|max:50',
            'file_format'       => 'nullable|string|max:100',
            'license'           => 'nullable|string|max:100',
            'main_image'        => ($isCreate ? 'required' : 'nullable') . '|image|mimes:jpg,jpeg,png,webp|max:4096',
            'category_id'       => 'nullable|exists:categories,id',
        ]);
    }

    private function validateExtraImages(Request $request, bool $required = false): void
    {
        $rules = $required
            ? ['images' => 'required|array|min:1', 'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096']
            : ['images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096'];
        $request->validate($rules);
    }

    private function saveExtraImages(Request $request, Product $product): void
    {
        if (!$request->hasFile('images')) return;
        $sort = (int) $product->images()->max('sort') + 1;
        foreach ($request->file('images') as $file) {
            $path = $file->store('products', 'public');
            ProductImage::create([
                'product_id' => $product->id,
                'path'       => $path,
                'sort'       => $sort++,
            ]);
        }
    }
}