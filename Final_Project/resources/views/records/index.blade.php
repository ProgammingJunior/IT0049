@extends('layouts.pos')
@php
$names=['products'=>'Products','customers'=>'Customers','staff'=>'Staff'];
$base=['products'=>'products','customers'=>'customers','staff'=>'users'][$kind];
@endphp
@php($archived = $archived ?? false)
@section('title',$names[$kind])
@section('content')
<div class="flex flex-wrap items-end justify-between gap-4">
<div><p class="text-sm font-semibold text-indigo-600">Store directory</p><h1 class="mt-1 text-3xl font-black tracking-tight">{{ $names[$kind] }}</h1><p class="mt-2 text-sm text-slate-500">Manage your {{ strtolower($names[$kind]) }} and keep the counter organized.</p></div>
<a href="{{ route($base.'.create') }}" class="rounded-xl bg-indigo-600 px-4 py-3 text-sm font-bold text-white hover:bg-indigo-700">＋ Add {{ $kind==='staff'?'staff':rtrim(strtolower($names[$kind]),'s') }}</a>
</div>
@if($kind==='products')
<div class="mt-6 flex flex-wrap gap-2"><a href="{{ route('products.index') }}" class="rounded-full px-4 py-2 text-xs font-bold {{ !$archived?'bg-slate-950 text-white':'bg-white text-slate-500 ring-1 ring-slate-200' }}">Active inventory</a><a href="{{ route('products.index',['archived'=>1]) }}" class="rounded-full px-4 py-2 text-xs font-bold {{ $archived?'bg-slate-950 text-white':'bg-white text-slate-500 ring-1 ring-slate-200' }}">Archived</a></div>
@endif
<div class="mt-6 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm">
<div class="flex flex-wrap items-center justify-between gap-3 border-b border-slate-100 px-5 py-4">
<div class="text-sm font-bold text-slate-800">{{ $items->total() }} {{ strtolower($names[$kind]) }}</div>
<form method="GET" class="flex gap-2"><input name="search" value="{{ request('search') }}" placeholder="Search {{ strtolower($names[$kind]) }}..." class="w-56 rounded-xl border-slate-200 text-sm focus:border-indigo-500 focus:ring-indigo-500"><input type="hidden" name="archived" value="{{ $archived?1:0 }}"><button class="rounded-xl bg-slate-100 px-4 text-xs font-bold text-slate-700 hover:bg-slate-200">Search</button></form>
</div>
<div class="overflow-x-auto"><table class="w-full min-w-[720px] text-left text-sm"><thead class="bg-slate-50 text-[10px] font-bold uppercase tracking-wider text-slate-400"><tr>
@if($kind==='products')<th class="px-5 py-3">Product</th><th class="px-5 py-3">Price</th><th class="px-5 py-3">In stock</th><th class="px-5 py-3">Sales</th>
@elseif($kind==='customers')<th class="px-5 py-3">Customer</th><th class="px-5 py-3">Email</th><th class="px-5 py-3">Phone</th><th class="px-5 py-3">Transactions</th>
@else<th class="px-5 py-3">Team member</th><th class="px-5 py-3">Username</th><th class="px-5 py-3">Email</th><th class="px-5 py-3">Sales</th>@endif
<th class="px-5 py-3 text-right">Action</th></tr></thead><tbody class="divide-y divide-slate-100">
@forelse($items as $item)<tr class="hover:bg-slate-50/70">
@if($kind==='products')
<td class="px-5 py-4"><div class="flex items-center gap-3">@if($item->image)<img src="{{ asset('storage/'.$item->image) }}" class="h-11 w-11 rounded-xl object-cover" alt="">@else<span class="grid h-11 w-11 place-items-center rounded-xl bg-indigo-50 text-lg text-indigo-600">▦</span>@endif<div><a href="{{ route('products.show',$item) }}" class="font-bold hover:text-indigo-600">{{ $item->name }}</a><div class="mt-1 text-xs text-slate-400">SKU #{{ str_pad($item->id,4,'0',STR_PAD_LEFT) }}</div></div></div></td>
<td class="px-5 py-4 font-semibold">₱{{ number_format($item->price,2) }}</td><td class="px-5 py-4"><span class="rounded-full px-2.5 py-1 text-xs font-bold {{ $item->stock_quantity<=5?'bg-amber-50 text-amber-700':'bg-emerald-50 text-emerald-700' }}">{{ $item->stock_quantity }} units</span></td><td class="px-5 py-4 text-slate-500">{{ $item->sales_count }}</td>
@elseif($kind==='customers')
<td class="px-5 py-4"><a href="{{ route('customers.show',$item) }}" class="font-bold hover:text-indigo-600">{{ $item->full_name }}</a></td><td class="px-5 py-4 text-slate-500">{{ $item->email }}</td><td class="px-5 py-4 text-slate-500">{{ $item->phone ?: '—' }}</td><td class="px-5 py-4 text-slate-500">{{ $item->sales_count }}</td>
@else
<td class="px-5 py-4"><div class="flex items-center gap-3">@if($item->avatar)<img src="{{ asset('storage/'.$item->avatar) }}" class="h-10 w-10 rounded-full object-cover" alt="">@else<span class="grid h-10 w-10 place-items-center rounded-full bg-violet-100 font-bold text-violet-700">{{ strtoupper(substr($item->full_name,0,1)) }}</span>@endif<a href="{{ route('users.show',$item) }}" class="font-bold hover:text-indigo-600">{{ $item->full_name }}</a></div></td><td class="px-5 py-4 text-slate-500">{{ '@'.$item->username }}</td><td class="px-5 py-4 text-slate-500">{{ $item->email }}</td><td class="px-5 py-4 text-slate-500">{{ $item->sales_count }}</td>
@endif
<td class="px-5 py-4 text-right"><a href="{{ route($base.'.show',$item) }}" class="rounded-lg border border-slate-200 px-3 py-2 text-xs font-bold text-slate-600 hover:border-indigo-300 hover:text-indigo-600">View</a></td>
</tr>
@empty<tr><td colspan="5" class="px-5 py-12 text-center"><div class="text-sm font-bold text-slate-600">Nothing here yet</div><div class="mt-1 text-xs text-slate-400">Add a record or adjust your search.</div></td></tr>@endforelse
</tbody></table></div>
<div class="border-t border-slate-100 px-5 py-4">{{ $items->links() }}</div>
</div>
@endsection
