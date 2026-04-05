<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body class="iframe-footer">

<footer>
    <a href="{{ route('home') }}" class="logo-footer">
        <img src="{{ asset('images/logo.svg') }}" alt="Logo">
    </a>

    <div class="footer-col">
        <h4>Contact</h4>
        <p><a href="tel:+421900000000" target="_top">+421 900 000 000</a></p>
        <p><a href="mailto:contact@gmail.com">contact@gmail.com</a></p>
    </div>

    <div class="footer-col">
        <h4>Location</h4>
        <p>Bratislava</p>
        <p>Slovakia</p>
    </div>
</footer>

</body>
</html>