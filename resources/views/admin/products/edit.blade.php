@extends('admin.layout')
@section('title', 'Edit: ' . $product->name)
@section('content')

<div style="margin-bottom:1.2rem;display:flex;align-items:center;gap:1rem;flex-wrap:wrap;">
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary btn-sm">← Back</a>
    <a href="{{ route('product.show', $product) }}" class="btn btn-secondary btn-sm" target="_blank">👁 View on Store</a>
    <form class="delete-form" method="POST" action="{{ route('admin.products.destroy', $product) }}"
          onsubmit="return confirm('Permanently delete \'{{ addslashes($product->name) }}\'?')">
        @csrf @method('DELETE')
        <button type="submit" class="btn btn-danger btn-sm">🗑 Delete Product</button>
    </form>
</div>

<div class="form-card">
    @include('admin.products._form', [
        'product' => $product,
        'action'  => route('admin.products.update', $product),
        'method'  => 'PUT',
    ])
</div>
@endsection