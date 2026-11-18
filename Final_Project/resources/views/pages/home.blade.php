@extends('layouts.pos')
@section('title','Welcome')
@section('content')
<div class="grid gap-8 lg:grid-cols-[1.15fr_.85fr] lg:items-center">
<div class="py-5">
<div class="inline-flex items-center gap-2 rounded-full border border-indigo-100 bg-indigo-50 px-3 py-1.5 text-xs font-bold uppercase tracking-wider text-indigo-700"><span class="h-2 w-2 rounded-full bg-emerald-500"></span> Your counter, made simpler</div>
<h1 class="mt-6 max-w-2xl text-4xl font-black leading-tight tracking-tight text-slate-950 sm:text-6xl">A better day starts with a <span class="text-indigo-600">clear checkout.</span></h1>
<p class="mt-5 max-w-xl text-base leading-7 text-slate-600">QuickSale keeps your products, customers, team, and sales in one calm workspace. Check stock, record a sale, and keep moving.</p>
<div class="mt-8 flex flex-wrap gap-3">
@auth<a href="{{ route('dashboard') }}" class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 hover:bg-indigo-700">Open dashboard <span class="ml-2">→</span></a>
@else<a href="{{ route('login') }}" class="rounded-xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-600/20 hover:bg-indigo-700">Sign in to QuickSale <span class="ml-2">→</span></a><a href="{{ route('register') }}" class="rounded-xl border border-slate-200 bg-white px-5 py-3 text-sm font-bold text-slate-700 hover:bg-slate-50">Create staff account</a>@endauth
</div>
<div class="mt-10 flex gap-8 border-t border-slate-200 pt-6 text-sm"><div><b class="block text-slate-950">Stock-aware</b><span class="mt-1 block text-slate-500">Every sale updates inventory</span></div><div><b class="block text-slate-950">Team-ready</b><span class="mt-1 block text-slate-500">Secure staff sign-in</span></div></div>
</div>
<div class="rounded-[2rem] bg-slate-950 p-5 text-white shadow-2xl shadow-slate-300 sm:p-7">
<div class="flex items-center justify-between"><div><div class="text-sm font-bold">Today at the counter</div><div class="mt-1 text-xs text-slate-400">A sample workspace preview</div></div><span class="rounded-full bg-emerald-400/10 px-3 py-1 text-xs font-bold text-emerald-300">OPEN</span></div>
<div class="mt-6 rounded-2xl bg-white p-5 text-slate-900">
<div class="flex justify-between text-xs font-semibold text-slate-500"><span>YOUR SHIFT</span><span>{{ now()->format('D, M j') }}</span></div>
<div class="mt-5 flex items-end justify-between"><div><div class="text-sm text-slate-500">House Coffee</div><div class="mt-1 text-2xl font-black">₱85.00</div></div><span class="rounded-xl bg-indigo-50 px-3 py-2 text-sm font-bold text-indigo-700">× 2</span></div>
<div class="my-5 border-t border-dashed border-slate-200"></div>
<div class="flex justify-between text-sm text-slate-500"><span>Subtotal</span><span>₱170.00</span></div><div class="mt-3 flex justify-between text-lg font-black"><span>Total</span><span>₱170.00</span></div>
<button class="mt-5 w-full rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white">Sale recorded ✓</button>
</div>
<div class="mt-5 grid grid-cols-3 gap-3 text-center"><div class="rounded-xl bg-white/5 p-3"><div class="text-lg font-black">06</div><div class="mt-1 text-[10px] text-slate-400">PRODUCTS</div></div><div class="rounded-xl bg-white/5 p-3"><div class="text-lg font-black">05</div><div class="mt-1 text-[10px] text-slate-400">CUSTOMERS</div></div><div class="rounded-xl bg-white/5 p-3"><div class="text-lg font-black">03</div><div class="mt-1 text-[10px] text-slate-400">STAFF</div></div></div>
</div>
</div>
@endsection
