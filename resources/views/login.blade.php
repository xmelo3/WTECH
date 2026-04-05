<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body> 

<main>
    <section class="login">
        <img src="../images/profile.svg" alt="Profile icon">
        <input type="text" placeholder="Email">
        <input type="text" placeholder="Password">
        <button class="login-btn">Login</button>
        <a href="register.html"><button class="register-btn">Register</button></a>
    </section>
</main>

<x-footer />

</body>
</html>