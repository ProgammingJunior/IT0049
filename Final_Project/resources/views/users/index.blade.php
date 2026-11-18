@extends('layouts.app')
@section('title','User Accounts')
@section('content')
<section class="page-heading heading-row"><div><p class="eyebrow">DIRECTORY · TEAM</p><h1>User Accounts</h1><p class="lead">Access is limited to authenticated staff.</p></div><a class="button primary" href="{{ route('users.create') }}">＋ Add user</a></section>
<div class="table-card"><table><thead><tr><th>User</th><th>Username</th><th>Email</th><th></th></tr></thead><tbody>
@forelse($users as $user)<tr><td><span class="user-cell"><img class="avatar" src="{{ $user->avatar ? Storage::url($user->avatar) : asset('images/avatar-placeholder.svg') }}" alt="" width="42" height="42"><span class="primary-cell">{{ $user->full_name }}</span></span></td><td>{{ '@'.$user->username }}</td><td>{{ $user->email }}</td><td><a class="text-button" href="{{ route('users.show',$user) }}">View</a> · <a class="text-button" href="{{ route('users.edit',$user) }}">Edit</a></td></tr>
@empty<tr><td colspan="4" class="empty-state">No user accounts yet.</td></tr>@endforelse
</tbody></table></div>
@endsection
