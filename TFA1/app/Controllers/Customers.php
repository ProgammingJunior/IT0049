<?php

namespace App\Controllers;

class Customers extends BaseController
{
    public function index(): string
    {
        $customers = [
            ['full_name' => 'Alice Johnson', 'email' => 'alice@example.com', 'phone' => '555-0101'],
            ['full_name' => 'Bob Smith', 'email' => 'bob@example.com', 'phone' => '555-0102'],
            ['full_name' => 'Carol Davis', 'email' => 'carol@example.com', 'phone' => '555-0103'],
            ['full_name' => 'David Brown', 'email' => 'david@example.com', 'phone' => '555-0104'],
            ['full_name' => 'Eva Wilson', 'email' => 'eva@example.com', 'phone' => '555-0105'],
        ];

        return view('customers', ['customers' => $customers]);
    }
}
