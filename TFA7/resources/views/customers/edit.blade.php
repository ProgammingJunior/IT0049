@extends('layouts.app')
@section('title', 'Edit Customer')
@section('content')
<section class="page-heading"><p class="eyebrow">UPDATE RECORD</p><h1>Edit customer</h1><p class="lead">Update {{ $customer->full_name }}’s contact information.</p></section>
@include('customers._form', ['customer' => $customer])
@endsection
