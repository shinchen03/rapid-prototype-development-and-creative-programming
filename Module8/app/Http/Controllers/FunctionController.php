<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FunctionController extends Controller
{
    public function home()
    {
        return view('function.home');
    }
    
    public function contact()
    {
        return view('function.contact');
    }
 
}
