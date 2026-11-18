@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
<section class="hero"><p class="eyebrow">STORE OPERATIONS · TFA6</p><h1>A clearer view of your accounts.</h1><p class="lead">A point-of-sale directory built with Laravel, migrations, seeders, and Eloquent.</p><div class="hero-actions"><a class="button button-primary" href="{{ route('customers.index') }}">Browse customers →</a><a class="button button-quiet" href="{{ route('users.index') }}">View team accounts</a></div></section>
<section class="stats-grid"><article class="stat-card"><span class="stat-label">CUSTOMER DIRECTORY</span><strong>Database-backed</strong><p>Contact records are retrieved through the Customer model.</p></article><article class="stat-card"><span class="stat-label">TEAM ACCOUNTS</span><strong>Seeded examples</strong><p>Repeatable sample accounts load through a Laravel seeder.</p></article><article class="stat-card stat-accent"><span class="stat-label">NEXT STEP</span><strong>Make it editable</strong><p>TFA7 adds validated forms and prepared profile-image uploads.</p></article></section>
@endsection
