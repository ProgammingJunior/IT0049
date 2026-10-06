<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;
use App\Models\TaskModel;

final class TaskController
{
    public function today(): void
    {
        $tasks = (new TaskModel(Database::connection()))->forDate(date('Y-m-d'));
        View::render('welcome', [
            'pageTitle' => "Today's tasks",
            'activePage' => 'home',
            'tasks' => $tasks,
        ]);
    }

    public function index(): void
    {
        $tasks = (new TaskModel(Database::connection()))->allOrderedByDate();
        View::render('tasks', [
            'pageTitle' => 'All tasks',
            'activePage' => 'tasks',
            'tasks' => $tasks,
        ]);
    }
}