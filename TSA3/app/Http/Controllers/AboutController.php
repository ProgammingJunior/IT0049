<?php
namespace App\Http\Controllers;
use Illuminate\View\View;
class AboutController extends Controller
{
    public function show(): View { return view('about'); }
}
