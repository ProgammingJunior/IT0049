@extends('layouts.app')
@section('title','POS Home')
@section('content')
<section class="hero"><p class="eyebrow">STORE OPERATIONS · TFA5</p><h1>A simple home for your store accounts.</h1><p class="lead">Explore customer and team directories in a first Laravel application.</p><div class="hero-actions"><a class="button button-primary" href="{{ route('customers.index') }}">Browse customers →</a><a class="button button-quiet" href="{{ route('users.index') }}">View user accounts</a></div></section>
<section class="stats-grid"><article class="stat-card"><span class="stat-label">CUSTOMERS</span><strong>Contact directory</strong><p>Five example customer records displayed from a static PHP array.</p></article><article class="stat-card"><span class="stat-label">TEAM</span><strong>User accounts</strong><p>Five example users displayed with a Blade loop.</p></article><article class="stat-card stat-accent"><span class="stat-label">NEXT STEP</span><strong>Connect a database</strong><p>TFA6 replaces the sample arrays with Eloquent and migrations.</p></article></section>
@endsection
