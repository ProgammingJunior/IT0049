<?php

namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table = 'customers';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['full_name', 'email', 'phone', 'created_at'];
    protected $useTimestamps = false;

    /** @return array<int, array<string, mixed>> */
    public function getCustomers(): array
    {
        return $this->builder()->orderBy('id', 'ASC')->get()->getResultArray();
    }
}