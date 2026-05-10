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

    {{-- ── GALLERY ────────────────────────────────────────────────────── --}}
    <section class="product-gallery" aria-label="Product images">

        <div class="main-image">
            <img id="mainImg"
                 src="{{ $product->main_image_url }}"
                 alt="{{ $product->name }}">
        </div>

        <div class="thumbnail-row">
            <div class="thumb-item active"
                onclick="switchThumb(this, '{{ $product->main_image_url }}', false)">
                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}">
            </div>
            @foreach($product->images as $img)
                <div class="thumb-item thumb-extra"
                    onclick="switchThumb(this, '{{ $img->url }}', true)">
                    <img src="{{ $img->url }}" alt="{{ $product->name }} extra view">
                </div>
            @endforeach
        </div>

    </section>

    {{-- ── SIDEBAR ─────────────────────────────────────────────────────── --}}
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

        @if($product->short_description)
        <p class="product-short-desc">{{ $product->short_description }}</p>
        @endif

        <hr class="sidebar-divider">

        <div class="author-box">
            <img src="{{ asset('images/profile.svg') }}" alt="Author avatar">
            <span class="author-name">{{ $product->user->name ?? 'WTECH' }}</span>
            <button class="follow-btn">Follow</button>
        </div>

        <hr class="sidebar-divider">

        <ul class="product-params">
            @foreach([
                'Filament'     => $product->filament,
                'Colour'       => $product->colour,
                'Pieces'       => $product->pieces,
                'Print time'   => $product->print_time,
                'Supports'     => $product->supports,
                'Infill'       => $product->infill,
                'Layer height' => $product->layer_height,
                'File format'  => $product->file_format,
                'License'      => $product->license,
            ] as $label => $value)
                @if($value)
                <li>
                    <span class="param-label">{{ $label }}</span>
                    <span class="param-value">{{ $value }}</span>
                </li>
                @endif
            @endforeach
        </ul>

        <hr class="sidebar-divider">

        <div class="price-box">
            <span class="price">€{{ number_format($product->price, 2) }}</span>
        </div>

        <form method="POST" action="{{ route('cart.add', $product) }}" class="add-to-cart-form">
            @csrf

            <div class="qty-control">
                <button type="button" onclick="changeQty(-1)">−</button>
                <input type="number" id="qty" name="quantity" value="1" min="1" max="999">
                <button type="button" onclick="changeQty(1)">+</button>
            </div>

            <button type="submit" class="buy-btn">
                Add to Cart
            </button>
        </form>

        @if(session('success'))
            <p class="cart-success">{{ session('success') }}</p>
        @endif

    </aside>

    {{-- ── DESCRIPTION ─────────────────────────────────────────────────── --}}
    <section class="product-description" aria-label="Product description">
        <div class="tabs" role="tablist">
            <button class="tab active" role="tab" onclick="switchTab(this,'tab-desc')">Description</button>
            <button class="tab"        role="tab" onclick="switchTab(this,'tab-specs')">Print Details</button>
        </div>

        <div id="tab-desc" class="tab-content" role="tabpanel">
            <p>{{ $product->description ?? 'No description provided.' }}</p>
        </div>

        <div id="tab-specs" class="tab-content" role="tabpanel" style="display:none;">
            <table style="width:100%;border-collapse:collapse;font-size:.9rem;">
                @foreach([
                    'Filament'     => $product->filament,
                    'Colour'       => $product->colour,
                    'Pieces'       => $product->pieces,
                    'Print time'   => $product->print_time,
                    'Supports'     => $product->supports,
                    'Infill'       => $product->infill,
                    'Layer height' => $product->layer_height,
                    'File format'  => $product->file_format,
                    'License'      => $product->license,
                ] as $label => $value)
                    @if($value)
                    <tr style="border-bottom:1px solid var(--color-border);">
                        <td style="padding:.6rem 1rem .6rem 0;color:#666;font-weight:600;white-space:nowrap;">{{ $label }}</td>
                        <td style="padding:.6rem 0;">{{ $value }}</td>
                    </tr>
                    @endif
                @endforeach
            </table>
        </div>
    </section>

</main>

<x-footer />

<script src="{{ asset('js/detail.js') }}"></script>
</body>
</html>