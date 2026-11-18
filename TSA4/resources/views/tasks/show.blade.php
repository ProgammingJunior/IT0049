@extends('layouts.app')
@section('title','Task Details')
@section('content')
<section class="welcome-row"><div><p class="eyebrow">TASK DETAILS</p><h1>{{ $task->title }}</h1><p class="subhead">{{ $task->task_date->format('l, F j, Y') }}</p></div><span class="status status-{{ str_replace(' ', '-', $task->status) }}">{{ $task->status }}</span></section>
<div class="form-card"><p>This task remains in the database until it is archived.</p><div class="form-actions"><a class="button quiet" href="{{ route('tasks.index') }}">Back to tasks</a><a class="button primary" href="{{ route('tasks.edit',$task) }}">Edit task</a><form method="POST" action="{{ route('tasks.destroy',$task) }}" onsubmit="return confirm('Archive this task?')">@csrf @method('DELETE')<button class="button danger">Archive</button></form></div></div>
@endsection
