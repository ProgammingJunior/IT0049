<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'full_name', 'created_at', 'avatar', 'password'];
    protected $useTimestamps = false;

    /** @return array<int, array<string, mixed>> */
    public function getUsers(): array
    {
        return $this->builder()
            ->select('id, username, full_name, created_at, avatar')
            ->orderBy('id', 'ASC')
            ->get()
            ->getResultArray();
    }

    /** @return array<string, mixed>|null */
    public function getUser(int $id): ?array
    {
        $row = $this->builder()
            ->select('id, username, full_name, created_at, avatar')
            ->where('id', $id)
            ->get()
            ->getRowArray();

        return $row ?: null;
    }

    /** @return array<string, mixed>|null */
    public function findByUsername(string $username): ?array
    {
        $row = $this->builder()
            ->where('username', $username)
            ->get()
            ->getRowArray();

        return $row ?: null;
    }
}