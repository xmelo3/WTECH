@extends('admin.layout')
@section('title', 'Add Product')
@section('content')
<div class="form-card">
    @include('admin.products._form', [
        'product' => new \App\Models\Product(),
        'action'  => route('admin.products.store'),
        'method'  => 'POST',
    ])
</div>
@endsection