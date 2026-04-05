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
        <input type="text" placeholder="Username">
        <input type="text" placeholder="Password">
        <input type="text" placeholder="Repeat password">
        <button class="login-btn">Register</button>
    </section>
</main>

<x-footer />

</body>
</html>