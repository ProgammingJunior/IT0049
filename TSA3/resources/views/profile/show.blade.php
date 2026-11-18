@extends('layouts.app')
@section('title','Profile')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">YOUR ACCOUNT</p><h1>Profile</h1><p class="subhead">The single user record from the database.</p></div></section>
<article class="profile-card"><div class="profile-avatar">{{ strtoupper(substr($user->full_name,0,1)) }}</div><div><p class="eyebrow">TASK MANAGER USER</p><h2>{{ $user->full_name }}</h2><p class="profile-handle">@{{ $user->username }}</p><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></div></article>
@endsection
