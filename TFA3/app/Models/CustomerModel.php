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
    /** @return array<string, mixed>|null */
    public function getCustomer(int $id): ?array
    {
        $row = $this->builder()->where('id', $id)->get()->getRowArray();
        return $row ?: null;
    }
}