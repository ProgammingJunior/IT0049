@extends('layouts.app')
@section('title','All Tasks')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">TASK LIBRARY</p><h1>All tasks</h1><p class="subhead">Every active task, arranged by date.</p></div><div class="heading-actions"><span class="date-badge">{{ $tasks->count() }} active</span>@auth<a class="button primary" href="{{ route('tasks.create') }}">＋ New task</a>@endauth</div></section>
<div class="task-list">
@forelse($tasks as $task)<article class="task-row"><span class="task-check {{ $task->status==='done'?'checked':'' }}">{{ $task->status==='done'?'✓':'' }}</span><div class="task-copy"><strong>{{ $task->title }}</strong><span>{{ $task->task_date->format('l, M j, Y') }}</span></div><span class="status status-{{ str_replace(' ', '-', $task->status) }}">{{ $task->status }}</span>@auth<a class="text-button" href="{{ route('tasks.show',$task) }}">Manage</a>@endauth</article>
@empty<div class="empty-card"><h3>No active tasks.</h3><p>Archived tasks stay in the database and do not appear in this list.</p>@auth<a class="button primary" href="{{ route('tasks.create') }}">Create a task</a>@endauth</div>@endforelse
</div>
@endsection
