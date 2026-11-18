<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1"><title>@yield('title', 'TFA7 POS') · Northstar POS</title><link rel="stylesheet" href="{{ asset('css/app.css') }}"></head><body>
<header class="site-header"><a class="brand" href="{{ route('home') }}"><span class="brand-mark">N</span><span>Northstar <small>POINT OF SALE</small></span></a><nav><a href="{{ route('home') }}">Home</a><a href="{{ route('customers.index') }}">Customers</a><a href="{{ route('users.index') }}">Users</a><a href="{{ route('about') }}">About</a></nav></header><main class="container">
@if (session('success'))<div class="alert success" role="status">{{ session('success') }}</div>@endif
@if ($errors->any())<div class="alert failure" role="alert"><strong>Please correct the fields below.</strong><ul>@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>@endif
@yield('content')
</main><footer class="site-footer"><span>Northstar POS</span><span>TFA7 · Forms and image uploads</span></footer></body></html>
