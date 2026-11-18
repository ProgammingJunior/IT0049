@extends('layouts.app')
@section('title','Today')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">YOUR DAILY VIEW</p><h1>Today, made manageable.</h1><p class="subhead">{{ today()->format('l, F j, Y') }}</p></div><span class="date-badge">{{ $tasks->count() }} tasks today</span></section>
<section class="section-head"><div><h2>Today's focus</h2><p>Only active tasks scheduled for today appear here.</p></div><a class="text-link" href="{{ route('tasks.index') }}">View all tasks →</a></section>
<div class="task-list">
@forelse($tasks as $task)<article class="task-row"><span class="task-check {{ $task->status==='done'?'checked':'' }}">{{ $task->status==='done'?'✓':'' }}</span><div class="task-copy"><strong>{{ $task->title }}</strong><span>{{ $task->task_date->format('M j, Y') }}</span></div><span class="status status-{{ str_replace(' ', '-', $task->status) }}">{{ $task->status }}</span>@auth<a class="text-button" href="{{ route('tasks.edit',$task) }}">Edit</a>@endauth</article>
@empty<div class="empty-card"><span class="empty-icon">✦</span><h3>A clear day.</h3><p>No active tasks are scheduled for today.</p>@auth<a class="button primary" href="{{ route('tasks.create') }}">Create a task</a>@endauth</div>@endforelse
</div>
@endsection
