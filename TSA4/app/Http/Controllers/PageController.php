<?php
namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\View\View;
class PageController extends Controller
{
    public function home(): View
    {
        $tasks = Task::query()->where('is_archived', false)->whereDate('task_date', today())->orderBy('id')->get();
        return view('welcome', compact('tasks'));
    }
}
