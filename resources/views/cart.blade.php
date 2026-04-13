<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>

<x-header />

@auth
    <p>LOGGED IN as {{ auth()->user()->email }}</p>
@endauth

@guest
    <p>NOT logged in</p>
@endguest

<main class="cart-page">

    <div class="back-button">
        <button onclick="location.href='{{ route('home') }}'">← Back</button>
    </div>

    <div class="breadcrumbs">
        <a href="{{ route('cart') }}">Cart</a>
    </div>

    <div class="cart-container">
        <div class="products-in-cart">

            <div class="product-cart">
                <img src="{{ asset('images/st5.webp') }}" alt="Charizard">
                <div class="product-info">
                    <h4>Charizard</h4>
                    <p>Charizard model for pokemon enthusiasts.</p>
                </div>
                <div class="product-meta">
                    <p>1 × 24€</p>
                </div>
            </div>

            <div class="product-cart">
                <img src="{{ asset('images/st6.webp') }}" alt="Border Collie">
                <div class="product-info">
                    <h4>Border Collie</h4>
                    <p>Model of border collie breed, if you have one at home.</p>
                </div>
                <div class="product-meta">
                    <p>2 × 59€</p>
                </div>
            </div>

        </div>

        <div class="summary">
            <h2>Summary</h2>
            <hr>
            <ul class="summary-items">
                <li>Charizard × 1 → 24€</li>
                <li>Border Collie × 2 → 118€</li>
            </ul>
            <hr>
            <p class="total-price">Total price: 142€</p>
            <button class="checkout-btn" onclick="location.href='{{ route('checkout') }}'">Proceed to Checkout</button>
        </div>
    </div>

</main>

<x-footer />
</body>
</html>