<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Confirmation</title>

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
</head>
<body>

<x-header />

<main class="cart-page">

    <div class="breadcrumbs">
        <span class="current">Confirmation</span>
    </div>

    <div class="cart-container">

        <!-- LEFT SIDE -->
        <div class="products-in-cart">

            <h2>Payment Successful !</h2>
            <p>Thank you for your purchase!</p>

            <div class="summary" style="margin-top: 1em;">
                <h3>Order Details</h3>
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

                <p><strong>Order ID:</strong> #{{ $order->id }}</p>
                <p class="total-price">Total Paid: €{{ $order->total }}</p>
            </div>

            <div style="margin-top: 1.5em;">
                <a href="{{ route('home') }}" class="nav-btn">Continue Shopping</a>
            </div>

        </div>

        <!-- RIGHT SIDE -->
        <div class="summary">
            <h2>Payment Info</h2>
            <hr>

            <p><strong>Payment Method:</strong>
                {{ strtoupper($order->payment_method ?? 'N/A') }}
            </p>

            <p><strong>Status:</strong>
                <span>Paid</span>
            </p>

            <p><strong>Date:</strong>
                {{ $order->created_at->format('d.m.Y H:i') }}
            </p>

            <hr>

            <p style="font-size: 0.9rem;">
                A confirmation email has been sent.
            </p>
        </div>

    </div>

</main>

<x-footer />

</body>
</html>