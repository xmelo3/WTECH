<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

<header>
    <a href="{{ route('home') }}" class="logo">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo">
    </a>

    <div class="search">
        <input type="text" placeholder="Search..." aria-label="Search">
        <button aria-label="Submit search">
            <img src="{{ asset('images/search.svg') }}" alt="">
        </button>
    </div>

    <div class="header-right">
        <div class="login-register">
            <a href="{{ route('login') }}" class="nav-btn">Login</a>
            <a href="{{ route('register') }}" class="nav-btn">Register</a>
            <a href="{{ route('store') }}" class="nav-btn">Store</a>
        </div>

        <nav class="icons" aria-label="Site navigation">
            <a href="{{ route('home') }}">
                <img src="{{ asset('images/home.svg') }}" alt="Home">
            </a>
            <a href="{{ route('cart') }}">
                <img src="{{ asset('images/cart.svg') }}" alt="Cart">
            </a>
            <a href="{{ route('profile') }}">
                <img src="{{ asset('images/profile.svg') }}" alt="Profile">
            </a>
        </nav>
    </div>
</header>

</body>
</html>