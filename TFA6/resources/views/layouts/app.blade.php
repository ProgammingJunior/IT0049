<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'TFA6 POS') · Northstar POS</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
<header class="site-header">
    <a class="brand" href="{{ route('home') }}"><span class="brand-mark">N</span><span>Northstar <small>POINT OF SALE</small></span></a>
    <nav aria-label="Main navigation"><a href="{{ route('home') }}">Home</a><a href="{{ route('customers.index') }}">Customers</a><a href="{{ route('users.index') }}">Users</a><a href="{{ route('about') }}">About</a></nav>
</header>
<main class="container">@yield('content')</main>
<footer class="site-footer"><span>Northstar POS</span><span>TFA6 · Laravel and Eloquent</span></footer>
</body>
</html>
