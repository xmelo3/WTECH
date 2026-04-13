<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>

<x-header />

@auth
    <p>LOGGED IN as {{ auth()->user()->email }}</p>
@endauth

@guest
    <p>NOT logged in</p>
@endguest

<main class="profile-page">

    <section class="profile-top">
        <div class="avatar-wrap">
            <img src="{{ asset('images/st1.webp') }}" alt="Avatar" class="avatar-img">
        </div>
        <div class="bio-wrap">
            <p class="bio-label">BIO</p>
            <p class="bio-text">Welcome to my profile! I collect and share 3D models — animals, vehicles, characters and more.</p>
        </div>
    </section>

    <section class="profile-bar">
        <div class="profile-stats">
            <span>Likes: <strong>12</strong></span>
            <span>Followers: <strong>1234</strong></span>
            <span>Following: <strong>234</strong></span>
        </div>
        <div class="posts-search">
            <input type="text" placeholder="Search posts...">
            <button class="filter-btn">
                <img src="{{ asset('images/search.svg') }}" alt="Filter">
            </button>
        </div>
    </section>

    <section class="profile-posts">
        @foreach(range(2, 13) as $i)
            <a href="{{ route('detail') }}" class="post-item">
                <img src="{{ asset('images/st' . $i . '.webp') }}" alt="Post">
            </a>
        @endforeach
    </section>

</main>

<x-footer />
</body>
</html>