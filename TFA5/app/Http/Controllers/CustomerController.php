<?php
namespace App\Http\Controllers;
use Illuminate\View\View;
class CustomerController extends Controller
{
    public function index(): View
    {
        $customers = [
            ['full_name'=>'Alice Johnson','email'=>'alice@example.com','phone'=>'555-0101'],
            ['full_name'=>'Bob Smith','email'=>'bob@example.com','phone'=>'555-0102'],
            ['full_name'=>'Carol Davis','email'=>'carol@example.com','phone'=>'555-0103'],
            ['full_name'=>'David Brown','email'=>'david@example.com','phone'=>'555-0104'],
            ['full_name'=>'Eva Wilson','email'=>'eva@example.com','phone'=>'555-0105'],
        ];
        return view('customers.index', compact('customers'));
    }
}
