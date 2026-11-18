<!doctype html>
<html lang="{{ str_replace('_','-',app()->getLocale()) }}">
<head>
    <meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Daymark · @yield('title','Tasks for Today')</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
<header class="topbar">
    <a class="brand" href="{{ route('home') }}"><span class="brand-icon">D</span><span>daymark<small>YOUR DAY, IN VIEW</small></span></a>
    <nav aria-label="Main navigation">
        <a href="{{ route('home') }}">Today</a>
        <a href="{{ route('tasks.index') }}">All tasks</a>
        <a href="{{ route('profile') }}">Profile</a>
        <a href="{{ route('about') }}">About</a>
        @auth
            <a href="{{ route('tasks.create') }}">＋ New task</a>
            <form class="nav-form" method="POST" action="{{ route('logout') }}">@csrf<button type="submit">Sign out</button></form>
        @else
            <a href="{{ route('login') }}">Sign in</a>
            <a href="{{ route('register') }}">Register</a>
        @endauth
    </nav>
</header>
<main class="shell">
    @if (session('success'))
        <div class="alert success" role="status">{{ session('success') }}</div>
    @endif
    @if (session('error'))
        <div class="alert failure" role="alert">{{ session('error') }}</div>
    @endif
    @if ($errors->any())
        <div class="alert failure" role="alert"><strong>Please correct the fields below.</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
    @endif
    @yield('content')
    {{ $slot ?? '' }}
</main>
<footer class="footer"><span>Daymark · Tasks for Today</span><span>TSA4 · CRUD, authentication, and email</span></footer>
</body>
</html>
