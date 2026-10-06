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
}