<?php

namespace App\Controllers;

use App\Models\CustomerModel;

class Customers extends BaseController
{
    public function index(): string
    {
        return view('customers', [
            'title' => 'Customer Accounts',
            'activePage' => 'customers',
            'customers' => (new CustomerModel())->getCustomers(),
        ]);
    }
}