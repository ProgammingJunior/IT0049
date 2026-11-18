<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
<meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="csrf-token" content="{{ csrf_token() }}">
<title>@yield('title', 'Workspace') · QuickSale POS</title>
@vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="min-h-screen bg-slate-50 text-slate-900 antialiased">
<div class="min-h-screen lg:grid lg:grid-cols-[250px_minmax(0,1fr)]">
<aside class="bg-slate-950 px-5 py-6 text-white">
<a href="{{ route('home') }}" class="flex items-center gap-3">
<span class="grid h-11 w-11 place-items-center rounded-2xl bg-indigo-500 text-sm font-black">QS</span>
<span><span class="block text-lg font-bold">QuickSale</span><span class="text-xs text-slate-400">POINT OF SALE</span></span>
</a>
<div class="mt-10 text-[10px] font-bold uppercase tracking-[.22em] text-slate-500">Workspace</div>
<nav class="mt-3 space-y-1">
@auth
@foreach ([['dashboard','Overview','⌂'],['products.index','Products','▦'],['sales.create','Record sale','＋'],['sales.index','Sales history','↗'],['customers.index','Customers','◎'],['users.index','Staff','♙']] as [$routeName,$label,$icon])
<a href="{{ route($routeName) }}" class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-medium {{ request()->routeIs($routeName) || ($routeName === 'products.index' && request()->routeIs('products.*')) || ($routeName === 'sales.index' && request()->routeIs('sales.show')) ? 'bg-white/10 text-white' : 'text-slate-400 hover:bg-white/5 hover:text-white' }}">
<span class="w-5 text-center text-base">{{ $icon }}</span>{{ $label }}
</a>
@endforeach
@else
<a href="{{ route('home') }}" class="flex items-center gap-3 rounded-xl bg-white/10 px-3 py-2.5 text-sm font-medium text-white"><span class="w-5 text-center">⌂</span>Welcome</a>
@endauth
</nav>
<div class="mt-10 rounded-2xl border border-white/10 bg-white/5 p-4">
<div class="text-xs font-semibold text-indigo-300">Built for smoother service</div>
<p class="mt-2 text-xs leading-5 text-slate-400">Track products, customers, and every sale from one simple counter.</p>
</div>
<div class="mt-8 border-t border-white/10 pt-5 text-xs text-slate-500">QuickSale POS <span class="float-right">Laravel</span></div>
</aside>
<div class="min-w-0">
<header class="flex min-h-16 items-center justify-between border-b border-slate-200 bg-white px-5 sm:px-8">
<div><div class="text-xs font-medium text-slate-400">QuickSale / <span class="text-slate-700">@yield('title','Workspace')</span></div></div>
<div class="flex items-center gap-3">
@auth
<a href="{{ route('profile.edit') }}" class="hidden text-sm font-medium text-slate-600 hover:text-indigo-600 sm:block">{{ auth()->user()->full_name }}</a>
<form method="POST" action="{{ route('logout') }}">@csrf<button class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-semibold text-slate-600 hover:border-slate-400">Sign out</button></form>
@else
<a href="{{ route('login') }}" class="text-sm font-semibold text-slate-600 hover:text-indigo-600">Sign in</a>
<a href="{{ route('register') }}" class="rounded-lg bg-indigo-600 px-3 py-2 text-xs font-semibold text-white hover:bg-indigo-700">Create account</a>
@endauth
</div>
</header>
<main class="mx-auto max-w-7xl px-5 py-7 sm:px-8 sm:py-9">
@if (session('success'))<div class="mb-5 rounded-xl border border-emerald-200 bg-emerald-50 px-4 py-3 text-sm font-medium text-emerald-800">{{ session('success') }}</div>@endif
@if (session('error'))<div class="mb-5 rounded-xl border border-rose-200 bg-rose-50 px-4 py-3 text-sm font-medium text-rose-800">{{ session('error') }}</div>@endif
@yield('content')
</main>
<footer class="px-8 pb-6 text-xs text-slate-400">QuickSale POS · Sample data for demonstration</footer>
</div>
</div>
</body>
</html>
