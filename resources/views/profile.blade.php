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

<main class="profile-page">

    <section class="profile-top">
        <div class="avatar-wrap">
            <img src="../images/st1.webp" alt="Avatar" class="avatar-img">
        </div>
        <div class="bio-wrap">
            <p class="bio-label">BIO</p>
            <p class="bio-text">Welcome to my profile! I collect and share 3D models — animals, vehicles, characters and more. Feel free to browse my posts and grab something you like.</p>
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
                <img src="../images/search.svg" alt="Filter">
            </button>
        </div>
    </section>

    <section class="profile-posts">
        <a href="detail.html" class="post-item"><img src="../images/st2.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st3.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st4.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st5.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st6.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st7.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st8.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st9.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st10.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st11.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st12.webp" alt="Post"></a>
        <a href="detail.html" class="post-item"><img src="../images/st13.webp" alt="Post"></a>
    </section>

</main>

<x-footer />

</body>
</html>
