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

<main class="cart-page">

    <div class="back-button">
        <button onclick="location.href='{{ route('store') }}'">← Continue Shopping</button>
    </div>

    <div class="cart-container">

        <div class="products-in-cart">
            @forelse ($items as $item)
                <div class="product-cart">
                    <img src="{{ asset('storage/' . $item->product->main_image) }}" alt="{{ $item->product->name }}">
                    
                    <div class="product-info">
                        <h4>{{ $item->product->name }}</h4>
                        <p>{{ $item->product->short_description }}</p>
                    </div>

                    <div class="product-meta">
                        <form method="POST" action="{{ route('cart.update', $item) }}" class="quantity-form">
                            @csrf
                            @method('PATCH')
                            <button type="submit" name="quantity" value="{{ $item->quantity - 1 }}">−</button>
                            <span>{{ $item->quantity }}</span>
                            <button type="submit" name="quantity" value="{{ $item->quantity + 1 }}">+</button>
                        </form>
                        <p>{{$item->product->price }}€</p>
                        <form method="POST" action="{{ route('cart.remove', $item) }}" class="remove-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit">Remove</button>
                        </form>
                    </div>
                </div>
            @empty
                <p>Your cart is empty.</p>
            @endforelse
        </div>

        <div class="summary">
            <h2>Summary</h2>
            <hr>
            <ul class="summary-items">
                @foreach ($items as $item)
                    <li>{{ $item->product->name }} × {{ $item->quantity }} → {{ $item->quantity * $item->product->price }}€</li>
                @endforeach
            </ul>
            <hr>
            <p class="total-price">Total: {{ $items->sum(fn($item) => $item->quantity * $item->product->price) }}€</p>
            <button class="checkout-btn" onclick="location.href='{{ route('checkout') }}'">Proceed to Checkout</button>
        </div>

    </div> {{-- koniec cart-container --}}

</main>

<x-footer />
</body>
</html>