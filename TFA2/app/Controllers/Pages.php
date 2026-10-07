<?php

namespace App\Controllers;

class Pages extends BaseController
{
    public function home(): string
    {
        return view('home');
    }

    public function about(): string
    {
        return view('about');
    }
}
