@extends('layouts.app')
@section('title','Dashboard')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">SIGNED-IN WORKSPACE</p><h1>Welcome, {{ auth()->user()->full_name }}.</h1><p class="subhead">Your task-management actions are ready.</p></div><a class="button primary" href="{{ route('tasks.create') }}">＋ New task</a></section>
@endsection
