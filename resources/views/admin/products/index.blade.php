@extends('admin.layout')
@section('title', 'Products')
@section('content')

<div class="action-row">
    <form class="search-bar" method="GET" action="{{ route('admin.products.index') }}">
        <input type="search" name="q" value="{{ request('q') }}" placeholder="Search products…">
        <button type="submit" class="btn btn-secondary"> Search</button>
        @if(request('q'))<a href="{{ route('admin.products.index') }}" class="btn btn-secondary">✕ Clear</a>@endif
    </form>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
</div>

<table class="data-table">
    <thead>
        <tr><th>Image</th><th>Name</th><th>Price</th><th>Filament</th><th>Colour</th><th>Pieces</th><th>Format</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @forelse($products as $product)
        <tr>
            <td>
                @if($product->main_image)
                    <img class="product-thumb" src="{{ $product->main_image_url }}" alt="{{ $product->name }}">
                @else
                    <div class="product-thumb-placeholder"></div>
                @endif
            </td>
            <td>
                <strong>{{ $product->name }}</strong>
                @if($product->slug)<br><small style="color:#aaa;font-size:.75rem;">{{ $product->slug }}</small>@endif
            </td>
            <td>€{{ number_format($product->price, 2) }}</td>
            <td>{{ $product->filament ?? '—' }}</td>
            <td>{{ $product->colour ?? '—' }}</td>
            <td>{{ $product->pieces ?? '—' }}</td>
            <td>{{ $product->file_format ?? '—' }}</td>
            <td style="white-space:nowrap;">
                <a href="{{ route('product.show', $product) }}" class="btn btn-secondary btn-sm" target="_blank">👁 View</a>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary btn-sm"> Edit</a>
                <form class="delete-form" method="POST" action="{{ route('admin.products.destroy', $product) }}"
                      onsubmit="return confirm('Delete \'{{ addslashes($product->name) }}\'?')">
                    @csrf @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">🗑</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" style="text-align:center;color:#888;padding:2.5rem;">
                @if(request('q'))No products matching "{{ request('q') }}".
                @else No products yet. <a href="{{ route('admin.products.create') }}">Add one →</a>@endif
            </td>
        </tr>
        @endforelse
    </tbody>
</table>

@if($products->hasPages())
<div style="margin-top:1rem;">{{ $products->withQueryString()->links('pagination.custom') }}</div>
<p style="margin-top:.4rem;font-size:.8rem;color:#aaa;">
    Showing {{ $products->firstItem() }}–{{ $products->lastItem() }} of {{ $products->total() }}
</p>
@endif
@endsection