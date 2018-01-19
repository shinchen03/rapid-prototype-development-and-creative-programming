<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LearnController extends Controller{
    
    function show()
    {
        return view('function.learn');
    }
}

?>