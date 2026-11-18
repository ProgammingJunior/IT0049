@extends('layouts.app')
@section('title','Customer Accounts')
@section('content')
<section class="page-heading heading-row"><div><p class="eyebrow">DIRECTORY · CUSTOMERS</p><h1>Customer Accounts</h1><p class="lead">Sample data supplied by CustomerController.</p></div><span class="count-pill">{{ count($customers) }} records</span></section>
<div class="table-card"><table><thead><tr><th>Customer</th><th>Email</th><th>Phone</th></tr></thead><tbody>
@foreach($customers as $customer)<tr><td class="primary-cell">{{ $customer['full_name'] }}</td><td><a href="mailto:{{ $customer['email'] }}">{{ $customer['email'] }}</a></td><td>{{ $customer['phone'] }}</td></tr>@endforeach
</tbody></table></div>
@endsection
