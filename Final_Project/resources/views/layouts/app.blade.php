<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Northstar POS') }} · @yield('title', 'POS')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
<header class="site-header">
    <a class="brand" href="{{ route('home') }}"><span class="brand-mark">N</span><span>Northstar <small>POINT OF SALE</small></span></a>
    <nav aria-label="Main navigation">
        <a href="{{ route('home') }}">Home</a><a href="{{ route('about') }}">About</a>
        @auth
            <a href="{{ route('customers.index') }}">Customers</a><a href="{{ route('users.index') }}">Users</a><a href="{{ route('profile.edit') }}">Profile</a>
            <form class="nav-form" method="POST" action="{{ route('logout') }}">@csrf<button class="nav-button" type="submit">Sign out</button></form>
        @else
            <a href="{{ route('login') }}">Sign in</a><a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>
</header>
<main class="container">
    @if (session('success'))<div class="alert success" role="status">{{ session('success') }}</div>@endif
    @if (session('error'))<div class="alert failure" role="alert">{{ session('error') }}</div>@endif
    @if ($errors->any())<div class="alert failure" role="alert"><strong>Please correct the fields below.</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
    @yield('content')
    {{ $slot ?? '' }}
</main>
<footer class="site-footer"><span>Northstar POS</span><span>TFA8 · Resource controllers and authentication</span></footer>
</body></html>
