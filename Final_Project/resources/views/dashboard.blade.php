@extends('layouts.pos')
@section('title','Overview')
@section('content')
<div class="flex flex-wrap items-end justify-between gap-4">
<div><p class="text-sm font-semibold text-indigo-600">Good {{ now()->hour < 12 ? 'morning' : 'afternoon' }}, {{ auth()->user()->full_name }}</p><h1 class="mt-1 text-3xl font-black tracking-tight text-slate-950">Your counter at a glance</h1><p class="mt-2 text-sm text-slate-500">Here’s what’s happening in your store today.</p></div>
<a href="{{ route('sales.create') }}" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white shadow-md shadow-indigo-600/20 hover:bg-indigo-700">＋ Record a sale</a>
</div>
<div class="mt-7 grid gap-4 sm:grid-cols-2 xl:grid-cols-4">
@foreach ([['Today’s sales','₱'.number_format($todayRevenue,2),'Revenue recorded today','↗'],['Products',number_format($productCount),'Active in inventory','▦'],['Customers',number_format($customerCount),'Customer profiles','◎'],['Staff',number_format($staffCount),'Team accounts','♙']] as [$label,$value,$caption,$icon])
<div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm"><div class="flex items-center justify-between text-sm font-semibold text-slate-500"><span>{{ $label }}</span><span class="grid h-9 w-9 place-items-center rounded-xl bg-indigo-50 text-indigo-600">{{ $icon }}</span></div><div class="mt-5 text-3xl font-black tracking-tight text-slate-950">{{ $value }}</div><div class="mt-1 text-xs text-slate-400">{{ $caption }}</div></div>
@endforeach
</div>
<div class="mt-7 grid gap-6 xl:grid-cols-[1.4fr_.8fr]">
<section class="overflow-hidden rounded-2xl border border-slate-200 bg-white">
<div class="flex items-center justify-between border-b border-slate-100 px-5 py-4"><div><h2 class="font-bold text-slate-900">Recent sales</h2><p class="mt-1 text-xs text-slate-500">The latest transactions</p></div><a href="{{ route('sales.index') }}" class="text-xs font-bold text-indigo-600">View history →</a></div>
<div class="overflow-x-auto"><table class="w-full text-left text-sm"><thead class="bg-slate-50 text-[10px] font-bold uppercase tracking-wider text-slate-400"><tr><th class="px-5 py-3">Item</th><th class="px-5 py-3">Customer</th><th class="px-5 py-3">Total</th><th class="px-5 py-3">Time</th></tr></thead><tbody class="divide-y divide-slate-100">
@forelse($recentSales as $sale)<tr><td class="px-5 py-3.5 font-semibold"><a class="hover:text-indigo-600" href="{{ route('sales.show',$sale) }}">{{ $sale->product->name }}</a><span class="ml-1 text-xs font-normal text-slate-400">×{{ $sale->quantity }}</span></td><td class="px-5 py-3.5 text-slate-500">{{ $sale->customer?->full_name ?? 'Walk-in' }}</td><td class="px-5 py-3.5 font-bold">₱{{ number_format($sale->total_price,2) }}</td><td class="px-5 py-3.5 text-xs text-slate-500">{{ $sale->created_at->format('M j, g:i A') }}</td></tr>
@empty<tr><td colspan="4" class="px-5 py-8 text-center text-sm text-slate-400">No sales yet. Record your first sale to get started.</td></tr>@endforelse
</tbody></table></div>
</section>
<section class="rounded-2xl border border-slate-200 bg-white p-5"><div class="flex items-center justify-between"><div><h2 class="font-bold">Low stock</h2><p class="mt-1 text-xs text-slate-500">Five units or fewer</p></div><a href="{{ route('products.index') }}" class="text-xs font-bold text-indigo-600">Inventory →</a></div>
<div class="mt-5 space-y-4">@forelse($lowStock as $product)<div class="flex items-center justify-between gap-3"><div><div class="text-sm font-semibold">{{ $product->name }}</div><div class="mt-1 text-xs text-slate-400">Restock soon</div></div><span class="rounded-full bg-amber-50 px-3 py-1 text-xs font-bold text-amber-700">{{ $product->stock_quantity }} left</span></div>@empty<div class="rounded-xl bg-emerald-50 p-4 text-sm text-emerald-800">All active products have healthy stock.</div>@endforelse</div>
</section>
</div>
@endsection
