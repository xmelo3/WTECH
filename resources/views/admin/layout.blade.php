<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/admin_layout.css') }}">
    <title>Admin – @yield('title', 'Dashboard')</title>
</head>
<body>

<aside class="sidebar">
    <div class="sidebar-logo"> WTECH Admin</div>
    <nav>
        <a href="{{ route('admin.dashboard') }}"       class="{{ request()->routeIs('admin.dashboard')       ? 'active' : '' }}"> Dashboard</a>
        <a href="{{ route('admin.products.index') }}"  class="{{ request()->routeIs('admin.products.index')  ? 'active' : '' }}"> Products</a>
        <a href="{{ route('admin.products.create') }}" class="{{ request()->routeIs('admin.products.create') ? 'active' : '' }}"> Add Product</a>
    </nav>
    <div class="sidebar-footer">
        <a href="{{ route('home') }}" target="_blank"> View Store</a>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit"> Log Out</button>
        </form>
    </div>
</aside>

<div class="main-wrap">
    <div class="topbar">
        <h1>@yield('title', 'Dashboard')</h1>
        <span class="topbar-user"> {{ auth()->user()->name }}</span>
    </div>
    <div class="page-content">
        @if(session('success'))
            <div class="alert alert-success"> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert alert-error">
                this should be bug:
                <ul style="margin-top:.4rem;padding-left:1.2rem;">
                    @foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach
                </ul>
            </div>
        @endif
        @yield('content')
    </div>
</div>
</body>
</html>