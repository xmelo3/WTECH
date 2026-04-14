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
            @guest
                <a href="{{ route('login') }}" class="nav-btn">{{ __('Login') }}</a>
                <a href="{{ route('register') }}" class="nav-btn">{{ __('Register') }}</a>
            @else
                <form method="POST" action="{{ route('logout') }}" style="margin:0; display:contents;">
                    @csrf
                    <button type="submit" class="nav-btn">{{ __('Log Out') }}</button>
                </form>
            @endguest
            <a href="{{ route('store') }}" class="nav-btn">{{ __('Store') }}</a>
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

{{-- Hamburger menu overlay (mobile) --}}
<div class="hamburger-overlay" id="hamburgerOverlay">
    <div class="hamburger-menu">
        <button class="hamburger-close" onclick="toggleMenu()">✕</button>
        <a href="{{ route('store') }}" class="nav-btn">Store</a>
        @guest
            <a href="{{ route('login') }}" class="nav-btn">Login</a>
            <a href="{{ route('register') }}" class="nav-btn">Register</a>
        @else
            <form method="POST" action="{{ route('logout') }}" style="margin:0; display:contents;">
                @csrf
                <button type="submit" class="nav-btn">Log Out</button>
            </form>
        @endguest
    </div>
</div>

{{-- Bottom nav (mobile) --}}
<nav class="bottom-nav" aria-label="Mobile navigation">
    <a href="{{ route('home') }}">
        <img src="{{ asset('images/home.svg') }}" alt="Home">
        <span>Home</span>
    </a>
    <a href="{{ route('cart') }}">
        <img src="{{ asset('images/cart.svg') }}" alt="Cart">
        <span>Cart</span>
    </a>
    <a href="{{ route('profile') }}">
        <img src="{{ asset('images/profile.svg') }}" alt="Profile">
        <span>Profile</span>
    </a>
    <button class="hamburger-btn" onclick="toggleMenu()" aria-label="Menu">
        <img src="{{ asset('images/home.svg') }}" alt="" style="opacity:0; position:absolute;">
        <span class="hamburger-icon">☰</span>
        <span>Menu</span>
    </button>
</nav>

<script>
function toggleMenu() {
    document.getElementById('hamburgerOverlay').classList.toggle('active');
}
// close when clicking outside
document.getElementById('hamburgerOverlay').addEventListener('click', function(e) {
    if (e.target === this) toggleMenu();
});
</script>