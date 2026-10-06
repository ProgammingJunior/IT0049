<?php
declare(strict_types=1);

namespace App\Models;

use App\Core\Database;
use PDO;

final class TaskModel
{
    public function __construct(private readonly PDO $database)
    {
    }

    public function forDate(string $date): array
    {
        $statement = $this->database->prepare(
            'SELECT id, title, status, task_date, created_at FROM tasks WHERE task_date = :task_date ORDER BY id ASC'
        );
        $statement->execute(['task_date' => $date]);

        return $statement->fetchAll();
    }

    public function allOrderedByDate(): array
    {
        return $this->database
            ->query('SELECT id, title, status, task_date, created_at FROM tasks ORDER BY task_date ASC, id ASC')
            ->fetchAll();
    }
}