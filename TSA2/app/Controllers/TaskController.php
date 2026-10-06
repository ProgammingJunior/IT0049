<?php
declare(strict_types=1);

namespace App\Controllers;

use App\Core\Database;
use App\Core\View;
use App\Models\TaskModel;
use DateTimeImmutable;

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

    public function new(): void
    {
        require_login();
        $this->renderForm('New task', app_url('tasks'), [
            'title' => '',
            'status' => 'pending',
            'task_date' => date('Y-m-d'),
        ], [], 'Create task');
    }

    public function create(): void
    {
        require_login();
        require_csrf();
        [$values, $errors] = $this->validatedInput();
        if ($errors !== []) {
            http_response_code(422);
            $this->renderForm('New task', app_url('tasks'), $values, $errors, 'Create task');
            return;
        }

        (new TaskModel(Database::connection()))->create($values['title'], $values['status'], $values['task_date']);
        flash_set('success', 'Task created.');
        redirect_to('tasks');
    }

    public function edit(int $id): void
    {
        require_login();
        $task = (new TaskModel(Database::connection()))->findActive($id);
        if ($task === null) {
            flash_set('error', 'That task is unavailable.');
            redirect_to('tasks');
        }
        $this->renderForm('Edit task', app_url('tasks/' . $id . '/update'), $task, [], 'Save changes');
    }

    public function update(int $id): void
    {
        require_login();
        require_csrf();
        $model = new TaskModel(Database::connection());
        if ($model->findActive($id) === null) {
            flash_set('error', 'That task is unavailable.');
            redirect_to('tasks');
        }

        [$values, $errors] = $this->validatedInput();
        if ($errors !== []) {
            http_response_code(422);
            $this->renderForm('Edit task', app_url('tasks/' . $id . '/update'), $values, $errors, 'Save changes');
            return;
        }

        $model->update($id, $values['title'], $values['status'], $values['task_date']);
        flash_set('success', 'Task updated.');
        redirect_to('tasks');
    }

    public function archive(int $id): void
    {
        require_login();
        require_csrf();
        $model = new TaskModel(Database::connection());
        if ($model->findActive($id) === null) {
            flash_set('error', 'That task is unavailable.');
            redirect_to('tasks');
        }

        $model->archive($id);
        flash_set('success', 'Task archived.');
        redirect_to('tasks');
    }

    private function validatedInput(): array
    {
        $titleInput = $_POST['title'] ?? '';
        $dateInput = $_POST['task_date'] ?? '';
        $statusInput = $_POST['status'] ?? 'pending';
        $title = trim(is_string($titleInput) ? $titleInput : '');
        $date = is_string($dateInput) ? trim($dateInput) : '';
        $status = is_string($statusInput) ? $statusInput : '';
        $errors = [];

        if ($title === '') {
            $errors[] = 'Enter a task title.';
        } elseif (mb_strlen($title, 'UTF-8') > 150) {
            $errors[] = 'The task title must be 150 characters or fewer.';
        }
        $parsedDate = DateTimeImmutable::createFromFormat('!Y-m-d', $date);
        if ($date === '' || $parsedDate === false || $parsedDate->format('Y-m-d') !== $date) {
            $errors[] = 'Choose a valid task date.';
        }
        if (!in_array($status, ['pending', 'in progress', 'completed'], true)) {
            $errors[] = 'Choose a valid task status.';
        }

        return [
            ['title' => $title, 'task_date' => $date, 'status' => $status],
            $errors,
        ];
    }

    private function renderForm(string $title, string $action, array $values, array $errors, string $submitLabel): void
    {
        View::render('task-form', [
            'pageTitle' => $title,
            'activePage' => 'tasks',
            'formAction' => $action,
            'values' => $values,
            'errors' => $errors,
            'submitLabel' => $submitLabel,
        ]);
    }
}
