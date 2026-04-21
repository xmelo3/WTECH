<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $product->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
    <style>
        /* ── Image scaling fix ───────────────────────────────────────────── */
        .main-image {
            width: 100%;
            max-width: 700px;
            aspect-ratio: 1 / 1;
            border-radius: 20px;
            background: var(--color-surface);
            border: 1px solid var(--color-border);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .main-image img {
            width: 100%;
            height: 100%;
            object-fit: contain;        /* was: cover — now shows full model */
            border-radius: 20px;
            transition: transform 0.3s;
        }

        .main-image:hover img { transform: scale(1.04); }

        /* ── Thumbnails ──────────────────────────────────────────────────── */
        .thumbnail-row {
            display: flex;
            gap: 10px;
            overflow-x: auto;
            flex-wrap: nowrap;
            padding-bottom: 6px;
            -webkit-overflow-scrolling: touch;
        }

        .thumb-item {
            flex: 0 0 70px;
            height: 70px;
            border-radius: 10px;
            border: 2px solid transparent;
            cursor: pointer;
            overflow: hidden;
            background: var(--color-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: border-color 0.2s, transform 0.2s;
            flex-shrink: 0;
        }

        .thumb-item img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .thumb-item:hover,
        .thumb-item.active {
            border-color: #412700;
            transform: scale(1.06);
        }

        /* placeholder thumbnails for future extra angles */
        .thumb-placeholder {
            flex: 0 0 70px;
            height: 70px;
            border-radius: 10px;
            border: 2px dashed var(--color-border);
            background: var(--color-surface);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
            opacity: 0.4;
            flex-shrink: 0;
        }

        @media (max-width: 500px) {
            .thumb-item, .thumb-placeholder { flex: 0 0 56px; height: 56px; }
        }

        /* quantity control */
        .quantity-form {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 1rem;
            margin-bottom: 1em;
        }

        .quantity-form button {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 1px solid var(--color-border);
            background: var(--color-surface-2);
            font-size: 1.1rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .quantity-form span {
            font-size: 1.1rem;
            font-weight: 600;
            min-width: 24px;
            text-align: center;
        }
    </style>
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

        {{-- Thumbnail row: real image + 3 placeholders for future angles --}}
        <div class="thumbnail-row">
            <div class="thumb-item active"
                 onclick="switchThumb(this, '{{ $product->main_image_url }}')">
                <img src="{{ $product->main_image_url }}" alt="{{ $product->name }}">
            </div>
            <div class="thumb-placeholder" title="Additional view coming soon">🔄</div>
            <div class="thumb-placeholder" title="Additional view coming soon">⬆️</div>
            <div class="thumb-placeholder" title="Additional view coming soon">🔍</div>
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

        <form method="POST" action="{{ route('cart.add', $product) }}" style="margin-top:1em;">
            @csrf

            <div class="quantity-form">
                <button type="button" onclick="changeQty(-1)">−</button>
                <span id="qty-display">1</span>
                <button type="button" onclick="changeQty(1)">+</button>
            </div>

            <input type="hidden" name="quantity" id="quantity" value="1">

            <button type="submit" class="buy-btn">
                <img src="{{ asset('images/cart.svg') }}" alt="">
                Add to Cart
            </button>
        </form>

        @if(session('success'))
            <p style="color:green;font-size:1rem;text-align:center;margin-top:.5em;">
                {{ session('success') }}
            </p>
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

<script>
    /* qty stepper */
    let qty = 1;
    function changeQty(amount) {
        qty = Math.max(1, qty + amount);
        document.getElementById('qty-display').innerText = qty;
        document.getElementById('quantity').value = qty;
    }

    /* thumbnail switcher */
    function switchThumb(el, url) {
        document.querySelectorAll('.thumb-item').forEach(t => t.classList.remove('active'));
        el.classList.add('active');
        document.getElementById('mainImg').src = url;
    }

    /* tab switcher */
    function switchTab(btn, id) {
        document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
        document.querySelectorAll('.tab-content').forEach(c => c.style.display = 'none');
        btn.classList.add('active');
        document.getElementById(id).style.display = 'block';
    }
</script>
</body>
</html>