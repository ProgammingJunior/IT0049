<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['username', 'full_name', 'created_at'];
    protected $useTimestamps = false;

    /** @return array<int, array<string, mixed>> */
    public function getUsers(): array
    {
        return $this->builder()->orderBy('id', 'ASC')->get()->getResultArray();
    }
}