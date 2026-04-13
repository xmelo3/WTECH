<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>
<x-header />

<main class="cart-page">
    <div class="back-button">
        <button onclick="location.href='{{ route('cart') }}'">← Back</button>
    </div>

    <div class="breadcrumbs">
        <a href="{{ route('cart') }}">Cart</a>
        <span>→</span>
        <span class="current">Checkout</span>
    </div>

    <form method="POST" action="{{ route('checkout.store') }}">
        @csrf
        <div class="cart-container">
            <div class="products-in-cart">
                <div class="form">
                    <h2>Shipping</h2>
                    <div class="shipping-methods">
                        <label class="shipping-option">
                            <input type="radio" name="shipping" value="alzabox" checked>
                            <div class="shipping-card">
                                <h4>AlzaBox</h4>
                                <p>Pickup point</p>
                                <span>€2.99</span>
                            </div>
                        </label>
                        <label class="shipping-option">
                            <input type="radio" name="shipping" value="courier">
                            <div class="shipping-card">
                                <h4>Courier</h4>
                                <p>Delivery to address</p>
                                <span>€2.99</span>
                            </div>
                        </label>
                    </div>

                    <h2>Information</h2>
                    <div class="form-row">
                        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" required>
                        <input type="text" name="surname" placeholder="Surname" value="{{ old('surname') }}" required>
                    </div>
                    <div class="form-row">
                        <input type="email" name="email" placeholder="Email" value="{{ old('email', auth()->user()->email) }}" required>
                    </div>
                    <div class="form-row">
                        <input type="text" name="city" placeholder="City" value="{{ old('city') }}" required>
                        <input type="text" name="postal_code" placeholder="Postal code" class="postal-code" value="{{ old('postal_code') }}" required>
                    </div>
                    <div class="form-row">
                        <input type="text" name="address" placeholder="Address" value="{{ old('address') }}" required>
                    </div>
                    <div class="form-row">
                        <input type="tel" name="phone" placeholder="Phone Number" value="{{ old('phone') }}" required>
                    </div>
                </div>
            </div>

            <div class="summary">
                <h2>Summary</h2>
                <hr>
                <ul class="summary-items">
                    @foreach ($items as $item)
                        <li>
                            <span>{{ $item->product->name }} × {{ $item->quantity }}</span>
                            <span>{{ $item->quantity * $item->product->price }}€</span>
                        </li>
                    @endforeach
                    <li>
                        <span>Shipping</span>
                        <span>€2.99</span>
                    </li>
                </ul>
                <hr>
                <p class="total-price">Total: {{ $items->sum(fn($i) => $i->quantity * $i->product->price) + 2.99 }}€</p>
                <button type="submit" class="checkout-btn">Proceed to Payment</button>
            </div>
        </div>
    </form>
</main>

<x-footer />
</body>
</html>