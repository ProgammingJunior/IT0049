@extends('layouts.app')
@section('title','Customer Accounts')
@section('content')
<section class="page-heading heading-row"><div><p class="eyebrow">DIRECTORY · CUSTOMERS</p><h1>Customer Accounts</h1><p class="lead">Manage POS customer records.</p></div><a class="button primary" href="{{ route('customers.create') }}">＋ Add customer</a></section>
<div class="table-card"><table><thead><tr><th>Customer</th><th>Email</th><th>Phone</th><th></th></tr></thead><tbody>
@forelse($customers as $customer)<tr><td class="primary-cell">{{ $customer->full_name }}</td><td>{{ $customer->email }}</td><td>{{ $customer->phone ?: '—' }}</td><td><a class="text-button" href="{{ route('customers.show',$customer) }}">View</a> · <a class="text-button" href="{{ route('customers.edit',$customer) }}">Edit</a></td></tr>
@empty<tr><td colspan="4" class="empty-state">No customer records yet.</td></tr>@endforelse
</tbody></table></div>
@endsection
