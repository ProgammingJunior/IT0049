<?php
namespace App\Http\Controllers;
use Illuminate\View\View;
class UserController extends Controller
{
    public function index(): View
    {
        $users = [
            ['username'=>'admin','full_name'=>'Alice Johnson'],
            ['username'=>'bsmith','full_name'=>'Bob Smith'],
            ['username'=>'cdavis','full_name'=>'Carol Davis'],
            ['username'=>'dbrown','full_name'=>'David Brown'],
            ['username'=>'ewilson','full_name'=>'Eva Wilson'],
        ];
        return view('users.index', compact('users'));
    }
}
