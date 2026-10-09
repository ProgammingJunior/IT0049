<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;
use RuntimeException;

class AddPasswordToUsers extends Migration
{
    public function up()
    {
        $this->forge->addColumn('users', [
            'password' => [
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => true,
            ],
        ]);

        $users = $this->db->table('users')->select('id')->get()->getResultArray();
        foreach ($users as $user) {
            $hash = password_hash('password123', PASSWORD_DEFAULT);
            if ($hash === false) {
                throw new RuntimeException('Could not hash the initial user password.');
            }

            $this->db->table('users')
                ->where('id', $user['id'])
                ->update(['password' => $hash]);
        }

        $this->forge->modifyColumn('users', [
            'password' => [
                'name' => 'password',
                'type' => 'VARCHAR',
                'constraint' => 255,
                'null' => false,
            ],
        ]);
    }

    public function down()
    {
        $this->forge->dropColumn('users', 'password');
    }
}