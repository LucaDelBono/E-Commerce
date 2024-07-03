<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function register()
    {
        return view('auth.register');
    }

    public function store()
    {
        $validated= request()->validate([
            'name'=>'required|min:2|max:30',
            'email'=>'required|email',
            'password'=>'confirmed'
        ]);

        User::create([
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>Hash::make($validated['password'])
        ]);

        return redirect()->route('register');
    }

    public function login()
    {
        return view('auth.login');
    }

    public function authenticate()
    {
        $validated= request()->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);

        if(auth()->attempt($validated)){
            request()->session()->regenerate();
            return redirect()->route('index');
        }else{
            return redirect()->route('login')->withErrors('error', 'Credenziali errate.');
        }
    }

    public function logout()
    {
        auth()->logout();
        request()->session()->invalidate();
        request()->session()->regenerate();
        return redirect()->route('login');
    }
}
