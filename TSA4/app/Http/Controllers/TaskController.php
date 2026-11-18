<?php
namespace App\Http\Controllers;
use App\Mail\TaskCompleted;
use App\Models\Task;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\View\View;
class TaskController extends Controller
{
    public function index(): View
    {
        $tasks = Task::query()->where('is_archived', false)->orderBy('task_date')->orderBy('id')->get();
        return view('tasks.index', compact('tasks'));
    }
    public function create(): View
    {
        return view('tasks.create', ['task'=>new Task(['task_date'=>today(),'status'=>'pending'])]);
    }
    public function store(Request $request): RedirectResponse
    {
        $data=$request->validate([
            'title'=>['required','string','max:150'],
            'status'=>['required','in:pending,in progress,done'],
            'task_date'=>['required','date'],
        ]);
        Task::create($data);
        return redirect()->route('tasks.index')->with('success','Task created.');
    }
    public function show(Task $task): View
    {
        abort_if($task->is_archived,404);
        return view('tasks.show',compact('task'));
    }
    public function edit(Task $task): View
    {
        abort_if($task->is_archived,404);
        return view('tasks.edit',compact('task'));
    }
    public function update(Request $request, Task $task): RedirectResponse
    {
        abort_if($task->is_archived,404);
        $data=$request->validate([
            'title'=>['required','string','max:150'],
            'status'=>['required','in:pending,in progress,done'],
            'task_date'=>['required','date'],
        ]);
        $sendCompletionNotice=$task->status!=='done' && $data['status']==='done';
        $task->update($data);
        if($sendCompletionNotice){
            Mail::to(config('tasks.notification_email'))->send(new TaskCompleted($task));
        }
        return redirect()->route('tasks.show',$task)->with('success','Task updated.');
    }
    public function destroy(Task $task): RedirectResponse
    {
        $task->update(['is_archived'=>true]);
        return redirect()->route('tasks.index')->with('success','Task archived.');
    }
}
