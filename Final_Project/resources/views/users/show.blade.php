@extends('layouts.app')
@section('title','User Details')
@section('content')
<section class="page-heading"><p class="eyebrow">TEAM ACCOUNT</p><h1>{{ $user->full_name }}</h1><p class="lead">{{ '@'.$user->username }} · {{ $user->email }}</p></section>
<div class="form-card"><img class="avatar avatar-large" src="{{ $user->avatar ? Storage::url($user->avatar) : asset('images/avatar-placeholder.svg') }}" alt=""><div class="form-actions"><a class="button quiet" href="{{ route('users.edit',$user) }}">Edit account</a>@unless($user->is(auth()->user()))<form method="POST" action="{{ route('users.destroy',$user) }}" onsubmit="return confirm('Delete this user account?')">@csrf @method('DELETE')<button class="button danger">Delete account</button></form>@endunless</div></div>
@endsection
