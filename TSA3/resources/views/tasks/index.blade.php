@extends('layouts.app')
@section('title','All Tasks')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">TASK LIBRARY</p><h1>All tasks</h1><p class="subhead">Every task, arranged by date.</p></div><span class="date-badge">{{ $tasks->count() }} total</span></section>
<div class="task-list">
@forelse($tasks as $task)
<article class="task-row"><span class="task-check {{ $task->status === 'completed' ? 'checked' : '' }}">{{ $task->status === 'completed' ? '✓' : '' }}</span><div class="task-copy"><strong>{{ $task->title }}</strong><span>{{ $task->task_date->format('l, M j, Y') }}</span></div><span class="status status-{{ IlluminateSupportStr::slug($task->status) }}">{{ $task->status }}</span></article>
@empty<div class="empty-card"><h3>No tasks yet.</h3><p>Seed the database to add sample tasks.</p></div>@endforelse
</div>
@endsection
