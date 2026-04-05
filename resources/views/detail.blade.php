<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fox Puzzle – Detail</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/detail.css') }}">
</head>
<body>


<x-header />

<main class="detail-container">

    <section class="product-gallery" aria-label="Product images">
        <div class="main-image">
            <img src="../images/detail-main.webp" alt="Fox Puzzle – main view">
        </div>
        <div class="thumbnail-row" role="list">
            <img src="../images/detail1.webp" alt="Fox Puzzle view 1" role="listitem">
            <img src="../images/detail2.webp" alt="Fox Puzzle view 2" role="listitem">
            <img src="../images/detail3.webp" alt="Fox Puzzle view 3" role="listitem">
            <img src="../images/detail4.webp" alt="Fox Puzzle view 4" role="listitem">
        </div>
    </section>

  <aside class="product-sidebar" aria-label="Product details">

    <div class="product-header">
        <h1>Fox Puzzle</h1>
        <p class="rating" aria-label="Rated 4 out of 5, 120 reviews">
            <span aria-hidden="true">★★★★☆</span> (120 reviews)
        </p>
    </div>

    <p class="product-short-desc">
        Have you ever seen shorter desription of a puzzle than this? Never mind it is getting rather long. Anyways this is 3d fox puzzle 
    </p>

    <hr class="sidebar-divider">

    <div class="author-box">
        <img src="../images/profile.svg" alt="Author avatar">
        <span class="author-name">Janko Hraško</span>
        <button class="follow-btn">Follow</button>
    </div>

    <hr class="sidebar-divider">

    <ul class="product-params">
        <li>
            <span class="param-label">Filament</span>
            <span class="param-value">PLA / PETG</span>
        </li>
        <li>
            <span class="param-label">Pieces</span>
            <span class="param-value">24</span>
        </li>
        <li>
            <span class="param-label">Print time</span>
            <span class="param-value">~3 h</span>
        </li>
        <li>
            <span class="param-label">Supports</span>
            <span class="param-value">No</span>
        </li>
        <li>
            <span class="param-label">Infill</span>
            <span class="param-value">15 %</span>
        </li>
        <li>
            <span class="param-label">Layer height</span>
            <span class="param-value">0.2 mm</span>
        </li>
        <li>
            <span class="param-label">File format</span>
            <span class="param-value">STL, 3MF</span>
        </li>
        <li>
            <span class="param-label">License</span>
            <span class="param-value">Personal use</span>
        </li>
    </ul>

    <hr class="sidebar-divider">

    <div class="price-box">
        <span class="price">$4.99</span>
    </div>

    <a href="store.html" class="buy-btn">
        <img src="../images/cart.svg" alt="">
        Buy Now
    </a>

    <div class="icon-actions">
        <button aria-label="Add to wishlist"><img src="../images/heart_empty.svg" alt=""></button>
        <button aria-label="Share"><img src="../images/share.svg" alt=""></button>
        <button aria-label="Bookmark"><img src="../images/bookmark_empty.svg" alt=""></button>
    </div>

</aside>

    <section class="product-description" aria-label="Product description">
        <div class="tabs" role="tablist">
            <button class="tab active" role="tab" aria-selected="true">Description</button>
            <button class="tab" role="tab" aria-selected="false">Details</button>
            <button class="tab" role="tab" aria-selected="false">Reviews</button>
        </div>

        <div class="tab-content" role="tabpanel">
            <p>Detailed description of the model. Includes formats, textures, polycount and more.</p>
        </div>
    </section>

</main>

<x-footer />

</body>
</html>