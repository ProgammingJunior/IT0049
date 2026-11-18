<form class="form-card" method="POST" action="{{ $task->exists ? route('tasks.update',$task) : route('tasks.store') }}">
@csrf @if($task->exists) @method('PUT') @endif
<div class="field"><label for="title">Task title</label><input id="title" name="title" value="{{ old('title',$task->title) }}" required maxlength="150" autofocus>@error('title')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="field"><label for="task_date">Date</label><input id="task_date" type="date" name="task_date" value="{{ old('task_date',$task->task_date?->format('Y-m-d')) }}" required>@error('task_date')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="field"><label for="status">Status</label><select id="status" name="status" required>@foreach(['pending'=>'Pending','in progress'=>'In progress','done'=>'Done'] as $value=>$label)<option value="{{ $value }}" @selected(old('status',$task->status)===$value)>{{ $label }}</option>@endforeach</select>@error('status')<small class="field-error">{{ $message }}</small>@enderror</div>
<div class="form-actions"><a class="button quiet" href="{{ route('tasks.index') }}">Cancel</a><button class="button primary">{{ $task->exists?'Save changes':'Create task' }}</button></div>
</form>
