@extends('layouts.app')
@section('title','Staff dashboard')
@section('content')
<section class="hero"><p class="eyebrow">STAFF WORKSPACE</p><h1>Welcome, {{ auth()->user()->full_name }}.</h1><p class="lead">Your account is signed in. Choose a directory to manage.</p><div class="hero-actions"><a class="button primary" href="{{ route('customers.index') }}">Customer accounts</a><a class="button quiet" href="{{ route('users.index') }}">User accounts</a></div></section>
@endsection
