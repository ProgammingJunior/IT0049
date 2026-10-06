<?php
namespace App\Models;
use CodeIgniter\Model;
class StaffModel extends Model { protected $table='users'; protected $primaryKey='id'; protected $allowedFields=['username','full_name','password','avatar','created_at']; protected $useTimestamps=false; }