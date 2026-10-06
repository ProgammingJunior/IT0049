<?php
declare(strict_types=1);

namespace App\Models;

use PDO;

final class TaskModel
{
    public function __construct(private readonly PDO $database)
    {
    }

    public function forDate(string $date): array
    {
        $statement = $this->database->prepare(
            'SELECT id, title, status, task_date, created_at FROM tasks WHERE task_date = :task_date AND is_archived = 0 ORDER BY id ASC'
        );
        $statement->execute(['task_date' => $date]);
        return $statement->fetchAll();
    }

    public function allOrderedByDate(): array
    {
        return $this->database
            ->query('SELECT id, title, status, task_date, created_at FROM tasks WHERE is_archived = 0 ORDER BY task_date ASC, id ASC')
            ->fetchAll();
    }

    public function findActive(int $id): ?array
    {
        $statement = $this->database->prepare(
            'SELECT id, title, status, task_date FROM tasks WHERE id = :id AND is_archived = 0 LIMIT 1'
        );
        $statement->execute(['id' => $id]);
        $task = $statement->fetch();
        return $task === false ? null : $task;
    }

    public function create(string $title, string $status, string $date): void
    {
        $statement = $this->database->prepare(
            'INSERT INTO tasks (title, status, task_date, created_at, is_archived) VALUES (:title, :status, :task_date, NOW(), 0)'
        );
        $statement->execute(['title' => $title, 'status' => $status, 'task_date' => $date]);
    }

    public function update(int $id, string $title, string $status, string $date): void
    {
        $statement = $this->database->prepare(
            'UPDATE tasks SET title = :title, status = :status, task_date = :task_date WHERE id = :id AND is_archived = 0'
        );
        $statement->execute(['id' => $id, 'title' => $title, 'status' => $status, 'task_date' => $date]);
    }

    public function archive(int $id): void
    {
        $statement = $this->database->prepare(
            'UPDATE tasks SET is_archived = 1 WHERE id = :id AND is_archived = 0'
        );
        $statement->execute(['id' => $id]);
    }
}
