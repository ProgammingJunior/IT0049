<?php
declare(strict_types=1);

namespace App\Models;

use PDO;

final class UserModel
{
    public function __construct(private readonly PDO $database)
    {
    }

    public function first(): ?array
    {
        $user = $this->database
            ->query('SELECT id, username, full_name, email, created_at FROM users ORDER BY id ASC LIMIT 1')
            ->fetch();
        return $user === false ? null : $user;
    }

    public function findByUsername(string $username): ?array
    {
        $statement = $this->database->prepare(
            'SELECT id, username, full_name, email, password, created_at FROM users WHERE username = :username LIMIT 1'
        );
        $statement->execute(['username' => $username]);
        $user = $statement->fetch();
        return $user === false ? null : $user;
    }
}
