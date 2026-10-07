<?php

namespace App\Controllers;

use App\Models\UserModel;

class Users extends BaseController
{
    public function index(): string
    {
        return view('users', [
            'title' => 'User Accounts',
            'activePage' => 'users',
            'users' => (new UserModel())->getUsers(),
        ]);
    }
}