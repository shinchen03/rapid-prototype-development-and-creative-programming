<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest',['except' => 'destroy']);
    }
    
    public function register()
    {
        return view('Auth.register');
    }
    
    public function login()
    {    
        return view('Auth.login');
    }
    
    public function save()
    {
        if (! auth()->attemp(request(['email','password']))){
            return back()->withError([
                'message' => 'Please check your credentials and try again.'
            ]);
        }
        
        return redirect()->home();
    }
    
    public function destroy()
    {
        auth()->logout();
        return redirect()->home();
    }
    
    public function store()
    {
        $this->validate(request(),[
            
            'name' => 'required',
            "email" => 'required|email',
            "password" => 'required|confirmed'
        ]);
        
        $user = User::create(request(['name', 'email', 'password']));
        
        auth()->login($user);
        
        return redirect()->home();
    }
 
}