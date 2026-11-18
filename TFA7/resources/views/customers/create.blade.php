@extends('layouts.app')
@section('title', 'Create Customer')
@section('content')
<section class="page-heading"><p class="eyebrow">NEW RECORD</p><h1>Create customer</h1><p class="lead">Add a customer to the POS directory.</p></section>
@include('customers._form', ['customer' => $customer])
@endsection
