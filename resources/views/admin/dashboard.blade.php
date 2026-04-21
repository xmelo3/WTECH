@extends('admin.layout')
@section('title', 'Dashboard')
@section('content')

<div class="stats-grid">
    <div class="stat-card"><div class="stat-label">Total Products</div><div class="stat-value">{{ $totalProducts }}</div></div>
    <div class="stat-card"><div class="stat-label">Avg Price</div><div class="stat-value">€{{ number_format($avgPrice, 2) }}</div></div>
    <div class="stat-card"><div class="stat-label">Total Pieces</div><div class="stat-value">{{ number_format($totalPieces) }}</div></div>
</div>

<h2 style="font-size:1rem;font-weight:600;margin-bottom:1rem;color:#444;">Recently Added</h2>

<table class="data-table">
    <thead>
        <tr><th>Image</th><th>Name</th><th>Price</th><th>Filament</th><th>Added</th><th>Actions</th></tr>
    </thead>
    <tbody>
        @forelse($recentProducts as $product)
        <tr>
            <td>
                @if($product->main_image)
                    <img class="product-thumb" src="{{ $product->main_image_url }}" alt="{{ $product->name }}">
                @else
                    <div class="product-thumb-placeholder"></div>
                @endif
            </td>
            <td><strong>{{ $product->name }}</strong></td>
            <td>€{{ number_format($product->price, 2) }}</td>
            <td>{{ $product->filament ?? '—' }}</td>
            <td style="font-size:.8rem;color:#888;">{{ $product->created_at->diffForHumans() }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-secondary btn-sm"> Edit</a>
                <a href="{{ route('product.show', $product) }}" class="btn btn-secondary btn-sm" target="_blank">👁 View</a>
            </td>
        </tr>
        @empty
        <tr><td colspan="6" style="text-align:center;color:#888;padding:2rem;">No products yet. <a href="{{ route('admin.products.create') }}">Add one →</a></td></tr>
        @endforelse
    </tbody>
</table>
@endsection