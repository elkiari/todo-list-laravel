<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthManager extends Controller
{
    function login()
    {
        return view('auth.login');
    }

    function loginPost(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials))
        {
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with('error', 'Invalid Email or Password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect(route('login'));
    }

    function register()
    {
        return view('auth.register');
    }

    function registerPost(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8',
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = $request->password;

        if($user->save())
        {
            return redirect(route('login'))->with('success', 'Registration Successful');
        }

        return redirect(route('register'))->with('error', 'Registration Failed');
    }
}
