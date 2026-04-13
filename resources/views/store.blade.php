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

    <form id="filter-form" method="GET" action="{{ route('store') }}">

        {{-- Carry the active sort value through when filters are re-applied --}}
        <input type="hidden" name="sort" id="sort-hidden" value="{{ request('sort') }}">

        <aside class="filters">

            <h3>Filament Type</h3>
            <div class="filter-group">
                @foreach (['PLA', 'PETG', 'PLA/PETG'] as $type)
                    <label>
                        <input
                            type="checkbox"
                            name="filament[]"
                            value="{{ $type }}"
                            {{ in_array($type, request('filament', [])) ? 'checked' : '' }}
                        > {{ $type }}
                    </label>
                @endforeach
            </div>

            <h3>Price</h3>
            <div class="filter-group">
                <div class="price-range-wrapper">

                    <div class="price-display">
                        <span id="price-min-display">${{ request('min_price', $priceMin) }}</span>
                        <span id="price-max-display">${{ request('max_price', $priceMax) }}</span>
                    </div>

                    <div class="range-track-container">
                        <div class="range-track-fill" id="range-fill"></div>
                    </div>

                    <div class="range-inputs">
                        <input
                            type="range"
                            id="min-price-slider"
                            name="min_price"
                            min="{{ $priceMin }}"
                            max="{{ $priceMax }}"
                            step="1"
                            value="{{ request('min_price', $priceMin) }}"
                        >
                        <input
                            type="range"
                            id="max-price-slider"
                            name="max_price"
                            min="{{ $priceMin }}"
                            max="{{ $priceMax }}"
                            step="1"
                            value="{{ request('max_price', $priceMax) }}"
                        >
                    </div>

                </div>
            </div>

            <button type="submit" class="apply-btn">Apply Filters</button>
            <a href="{{ route('store') }}" class="clear-filters">Clear all filters</a>

        </aside>
    </form>

    <section class="products">

        <div class="store-top">
            <h2>All Products</h2>
            <select id="sort-select" aria-label="Sort products">
                <option value="">Sort by</option>
                <option value="price_asc"  {{ request('sort') === 'price_asc'  ? 'selected' : '' }}>Price (ascending))</option>
                <option value="price_desc" {{ request('sort') === 'price_desc' ? 'selected' : '' }}>Price (descending)</option>
                <option value="newest"     {{ request('sort') === 'newest'     ? 'selected' : '' }}>Newest</option>
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
                        <form method="POST" action="{{ route('cart.add', $product) }}">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <button type="submit" class="action-btn" aria-label="Add to cart">
                                <img src="{{ asset('images/cart.svg') }}" alt="">
                            </button>
                        </form>

                        {{-- Share ─ native share sheet on mobile, clipboard fallback on desktop --}}
                        <button
                            class="action-btn"
                            aria-label="Share"
                            data-share-url="{{ route('product.show', $product) }}"
                            data-share-title="{{ $product->name }}"
                            onclick="handleShare(this)"
                        >
                            <img src="{{ asset('images/share.svg') }}" alt="">
                        </button>

                        {{-- Favourite ─ toggles heart icon, stored in localStorage --}}
                        <button
                            class="action-btn favourite-btn"
                            aria-label="Add to favourites"
                            data-product-id="{{ $product->id }}"
                            onclick="toggleFavourite(this)"
                        >
                            <img
                                class="heart-icon"
                                src="{{ asset('images/heart_empty.svg') }}"
                                data-empty="{{ asset('images/heart_empty.svg') }}"
                                data-full="{{ asset('images/heart_full.svg') }}"
                                alt=""
                            >
                        </button>

                    </div>
                </div>
            @endforeach
        </div>

        {{-- Pagination --}}
        <div class="pagination">
            {{ $products->links('pagination.custom') }}
        </div>

    </section>

</main>

<x-footer />

<script>
/* ── Sort: update URL, preserve active filter params ─────────────────── */
document.getElementById('sort-select').addEventListener('change', function () {
    const url = new URL(window.location.href);

    if (this.value) {
        url.searchParams.set('sort', this.value);
    } else {
        url.searchParams.delete('sort');
    }

    url.searchParams.delete('page'); // reset to first page on sort change
    window.location.href = url.toString();
});

/* ── Dual range price slider ─────────────────────────────────────────── */
(function () {
    const minSlider  = document.getElementById('min-price-slider');
    const maxSlider  = document.getElementById('max-price-slider');
    const minDisplay = document.getElementById('price-min-display');
    const maxDisplay = document.getElementById('price-max-display');
    const fill       = document.getElementById('range-fill');

    const RANGE_MIN  = parseInt(minSlider.min);
    const RANGE_MAX  = parseInt(minSlider.max);
    const RANGE_SPAN = RANGE_MAX - RANGE_MIN;

    function update(movedSlider) {
        let lo = parseInt(minSlider.value);
        let hi = parseInt(maxSlider.value);

        // Prevent handles from crossing each other
        if (lo > hi) {
            if (movedSlider === minSlider) {
                minSlider.value = hi;
                lo = hi;
            } else {
                maxSlider.value = lo;
                hi = lo;
            }
        }

        minDisplay.textContent = '$' + lo;
        maxDisplay.textContent = '$' + hi;

        const leftPct  = ((lo - RANGE_MIN) / RANGE_SPAN) * 100;
        const rightPct = ((hi - RANGE_MIN) / RANGE_SPAN) * 100;
        fill.style.left  = leftPct + '%';
        fill.style.width = (rightPct - leftPct) + '%';
    }

    minSlider.addEventListener('input', function () { update(this); });
    maxSlider.addEventListener('input', function () { update(this); });

    update(null); // draw initial fill on page load
}());

/* ── Favourites (localStorage) ───────────────────────────────────────── */
const FAV_KEY = 'store_favourites';

function getFavourites() {
    try { return JSON.parse(localStorage.getItem(FAV_KEY)) || []; }
    catch (e) { return []; }
}

function toggleFavourite(btn) {
    const id   = parseInt(btn.dataset.productId);
    const img  = btn.querySelector('.heart-icon');
    const favs = getFavourites();
    const idx  = favs.indexOf(id);

    if (idx === -1) {
        favs.push(id);
        img.src = img.dataset.full;
        btn.setAttribute('aria-label', 'Remove from favourites');
    } else {
        favs.splice(idx, 1);
        img.src = img.dataset.empty;
        btn.setAttribute('aria-label', 'Add to favourites');
    }

    localStorage.setItem(FAV_KEY, JSON.stringify(favs));
}

// Restore heart states after each page load / pagination
document.addEventListener('DOMContentLoaded', function () {
    const favs = getFavourites();
    document.querySelectorAll('.favourite-btn').forEach(function (btn) {
        if (favs.includes(parseInt(btn.dataset.productId))) {
            const img = btn.querySelector('.heart-icon');
            img.src = img.dataset.full;
            btn.setAttribute('aria-label', 'Remove from favourites');
        }
    });
});

/* ── Share button ────────────────────────────────────────────────────── */
function handleShare(btn) {
    const url   = btn.dataset.shareUrl;
    const title = btn.dataset.shareTitle;

    if (navigator.share) {
        navigator.share({ title, url }).catch(() => {});
    } else {
        navigator.clipboard.writeText(url).then(function () {
            const prev = btn.getAttribute('aria-label');
            btn.setAttribute('aria-label', 'Link copied!');
            setTimeout(() => btn.setAttribute('aria-label', prev), 2000);
        });
    }
}
</script>

</body>
</html>