@extends('layouts.app')
@section('title', 'User Accounts')
@section('content')
<section class="page-heading heading-row"><div><p class="eyebrow">DIRECTORY · TEAM</p><h1>User Accounts</h1><p class="lead">Team records retrieved from the User Eloquent model.</p></div><span class="count-pill">{{ $users->count() }} records</span></section><div class="table-card"><table><thead><tr><th>Username</th><th>Full name</th><th>Added</th></tr></thead><tbody>
@forelse ($users as $user)
<tr><td><span class="username">{{ '@' . $user->username }}</span></td><td class="primary-cell">{{ $user->full_name }}</td><td>{{ $user->created_at?->format('M j, Y') }}</td></tr>
@empty
<tr><td colspan="3" class="empty-state">No accounts yet. Run the PosSeeder to add sample records.</td></tr>
@endforelse
</tbody></table></div>
@endsection
