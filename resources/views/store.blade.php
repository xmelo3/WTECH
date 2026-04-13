<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/store.css') }}">
</head>
<body>

<x-header />

<main class="store-page">

    <aside class="filters">
        <h3>Categories</h3>
        <div class="filter-group">
            <label><input type="checkbox"> Vehicles</label>
            <label><input type="checkbox"> Architecture</label>
            <label><input type="checkbox"> Electronics</label>
            <label><input type="checkbox"> Nature</label>
        </div>

        <h3>Price</h3>
        <div class="filter-group">
            <label><input type="radio" name="price"> Free</label>
            <label><input type="radio" name="price"> Under $10</label>
            <label><input type="radio" name="price"> $10 - $50</label>
            <label><input type="radio" name="price"> $50+</label>
        </div>

        <button class="apply-btn">Apply Filters</button>
    </aside>

    <section class="products">
        <div class="store-top">
            <h2>All Products</h2>
            <select>
                <option>Sort by</option>
                <option>Price (low → high)</option>
                <option>Price (high → low)</option>
                <option>Newest</option>
            </select>
        </div>

        <div class="product-grid">
            @foreach ($products as $product)
                <div class="product-card">
                    <a href="{{ route('product.show', $product) }}">
                        <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
                    </a>
                    <h4>{{ $product->name }}</h4>
                    <p>${{ number_format($product->price, 2) }}</p>
                    <div class="card-actions">
                        <button class="action-btn" aria-label="Add to cart">
                            <img src="{{ asset('images/cart.svg') }}" alt="">
                        </button>
                        <button class="action-btn" aria-label="Share">
                            <img src="{{ asset('images/share.svg') }}" alt="">
                        </button>
                        <button class="action-btn favorite" aria-label="Add to favourites">
                            <img src="{{ asset('images/heart_full.svg') }}" alt="">
                        </button>
                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            {{ $products->links() }}
        </div>
    </section>

</main>

<x-footer />
</body>
</html>