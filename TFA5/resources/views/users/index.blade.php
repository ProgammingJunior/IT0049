@extends('layouts.app')
@section('title','User Accounts')
@section('content')
<section class="page-heading heading-row"><div><p class="eyebrow">DIRECTORY · TEAM</p><h1>User Accounts</h1><p class="lead">Sample data supplied by UserController.</p></div><span class="count-pill">{{ count($users) }} records</span></section>
<div class="table-card"><table><thead><tr><th>Username</th><th>Full name</th></tr></thead><tbody>
@foreach($users as $user)<tr><td><span class="username">{{ '@'.$user['username'] }}</span></td><td class="primary-cell">{{ $user['full_name'] }}</td></tr>@endforeach
</tbody></table></div>
@endsection
