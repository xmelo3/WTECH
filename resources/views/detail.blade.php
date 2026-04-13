<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
</head>
<body>

<x-header />

<main class="detail-container">

    <section class="product-gallery" aria-label="Product images">
        <div class="main-image">
            <img src="{{ asset('storage/' . $product->main_image) }}" alt="{{ $product->name }}">
        </div>
    </section>

    <aside class="product-sidebar" aria-label="Product details">
        <div class="product-header">
            <h1>{{ $product->name }}</h1>
            <p class="rating" aria-label="Rated {{ $product->rating_avg }} out of 5, {{ $product->rating_count }} reviews">
                <span aria-hidden="true">
                    @for ($i = 1; $i <= 5; $i++)
                        {{ $i <= round($product->rating_avg) ? '★' : '☆' }}
                    @endfor
                </span>
                ({{ $product->rating_count }} reviews)
            </p>
        </div>

        <p class="product-short-desc">{{ $product->short_description }}</p>

        <hr class="sidebar-divider">

        <div class="author-box">
            <img src="{{ asset('images/profile.svg') }}" alt="Author avatar">
            <span class="author-name">{{ $product->user->name }}</span>
            <button class="follow-btn">Follow</button>
        </div>

        <hr class="sidebar-divider">

        <ul class="product-params">
            <li><span class="param-label">Filament</span><span class="param-value">{{ $product->filament }}</span></li>
            <li><span class="param-label">Pieces</span><span class="param-value">{{ $product->pieces }}</span></li>
            <li><span class="param-label">Print time</span><span class="param-value">{{ $product->print_time }}</span></li>
            <li><span class="param-label">Supports</span><span class="param-value">{{ $product->supports }}</span></li>
            <li><span class="param-label">Infill</span><span class="param-value">{{ $product->infill }}</span></li>
            <li><span class="param-label">Layer height</span><span class="param-value">{{ $product->layer_height }}</span></li>
            <li><span class="param-label">File format</span><span class="param-value">{{ $product->file_format }}</span></li>
            <li><span class="param-label">License</span><span class="param-value">{{ $product->license }}</span></li>
        </ul>

        <hr class="sidebar-divider">

        <div class="price-box">
            <span class="price">${{ number_format($product->price, 2) }}</span>
        </div>

        <form method="POST" action="{{ route('cart.add', $product) }}" style="margin:0; display:contents;">
            @csrf
            <button type="submit" class="buy-btn">
                <img src="{{ asset('images/cart.svg') }}" alt="">
                Add to Cart
            </button>
        </form>

        @if(session('success'))
            <p style="color: green; font-size: 1rem; text-align:center;">{{ session('success') }}</p>
        @endif
    </aside>

    <section class="product-description" aria-label="Product description">
        <div class="tabs" role="tablist">
            <button class="tab active" role="tab">Description</button>
        </div>
        <div class="tab-content" role="tabpanel">
            <p>{{ $product->description }}</p>
        </div>
    </section>

</main>

<x-footer />
</body>
</html>