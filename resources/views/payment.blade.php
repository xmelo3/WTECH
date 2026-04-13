<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>
<x-header />

<main class="cart-page">
    <div class="back-button">
        <button onclick="location.href='{{ route('checkout') }}'">← Back</button>
    </div>

    <div class="breadcrumbs">
        <a href="{{ route('cart') }}">Cart</a>
        <span>→</span>
        <a href="{{ route('checkout') }}">Checkout</a>
        <span>→</span>
        <span class="current">Payment</span>
    </div>

    <form method="POST" action="{{ route('payment.pay') }}">
        @csrf
        <div class="cart-container">
            <div class="products-in-cart">
                <h3>Payment Method</h3>
                <div class="payment-methods">
                    <label class="payment-option">
                        <input type="radio" name="payment" value="gpay" checked>
                        <img src="{{ asset('images/gpayr.svg') }}" alt="GPay">
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment" value="visa">
                        <img src="{{ asset('images/Visa.svg') }}" alt="Visa">
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment" value="applepay">
                        <img src="{{ asset('images/ApplePay.svg') }}" alt="Apple Pay">
                    </label>
                </div>

                <h3>Card Information</h3>
                <div class="form">
                    <div class="form-row">
                        <input type="text" placeholder="Name on Card">
                        <input type="text" placeholder="CCV" class="postal-code">
                    </div>
                    <div class="form-row">
                        <input type="text" placeholder="Card Number">
                        <input type="text" placeholder="Expiry Date" class="postal-code">
                    </div>
                </div>
            </div>

            <div class="summary">
                <h2>Summary</h2>
                <hr>
                <ul class="summary-items">
                    @foreach ($order->items as $item)
                        <li>
                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span>{{ $item->quantity * $item->price }}€</span>
                        </li>
                    @endforeach
                    <li>
                        <span>Shipping</span>
                        <span>€{{ $order->shipping_price }}</span>
                    </li>
                </ul>
                <hr>
                <p class="total-price">Total: €{{ $order->total }}</p>
                <button type="submit" class="checkout-btn">Pay Now</button>
            </div>
        </div>
    </form>
</main>

<x-footer />
</body>
</html>