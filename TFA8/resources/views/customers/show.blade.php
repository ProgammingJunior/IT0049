@extends('layouts.app')
@section('title','Customer Details')
@section('content')
<section class="page-heading"><p class="eyebrow">CUSTOMER RECORD</p><h1>{{ $customer->full_name }}</h1><p class="lead">{{ $customer->email }} · {{ $customer->phone ?: 'No phone number' }}</p></section>
<div class="form-card"><a class="button quiet" href="{{ route('customers.edit',$customer) }}">Edit details</a><form class="inline-form" method="POST" action="{{ route('customers.destroy',$customer) }}" onsubmit="return confirm('Delete this customer account?')">@csrf @method('DELETE')<button class="button danger">Delete account</button></form></div>
@endsection
