@extends('layouts.app')
@section('title', 'Customer Accounts')
@section('content')
<section class="page-heading heading-row"><div><p class="eyebrow">DIRECTORY · CUSTOMERS</p><h1>Customer Accounts</h1><p class="lead">Customer records loaded with the Customer Eloquent model.</p></div><span class="count-pill">{{ $customers->count() }} records</span></section><div class="table-card"><table><thead><tr><th>Customer</th><th>Email</th><th>Phone</th><th>Added</th></tr></thead><tbody>
@forelse ($customers as $customer)
<tr><td class="primary-cell">{{ $customer->full_name }}</td><td><a href="mailto:{{ $customer->email }}">{{ $customer->email }}</a></td><td>{{ $customer->phone ?: '—' }}</td><td>{{ $customer->created_at?->format('M j, Y') }}</td></tr>
@empty
<tr><td colspan="4" class="empty-state">No customers yet. Run the PosSeeder to add sample records.</td></tr>
@endforelse
</tbody></table></div>
@endsection
