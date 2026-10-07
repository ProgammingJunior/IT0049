<?php

namespace App\Controllers;

class Users extends BaseController
{
    public function index(): string
    {
        $users = [
            ['username' => 'admin', 'full_name' => 'Alice Johnson', 'role' => 'Manager'],
            ['username' => 'bsmith', 'full_name' => 'Bob Smith', 'role' => 'Cashier'],
            ['username' => 'cdavis', 'full_name' => 'Carol Davis', 'role' => 'Cashier'],
            ['username' => 'dbrown', 'full_name' => 'David Brown', 'role' => 'Inventory Clerk'],
            ['username' => 'ewilson', 'full_name' => 'Eva Wilson', 'role' => 'Administrator'],
        ];

        return view('users', ['users' => $users]);
    }
}
