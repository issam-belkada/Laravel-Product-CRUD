<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\User;

class authcontroller extends Controller
{
    public function showLoginForm()
    {
        return view('auth.loginform');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt($credentials)) {
            return redirect()->route('products.index')->with('success', 'Login successful');
            }

        return redirect()->back()->withErrors(['email' => 'Invalid credentials']);
    }


    public function showSignupForm()
    {
        return view('auth.signupform');
    }


    public function signup(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        Auth::login($user);
        return redirect()->route('products.index')->with('success', 'Signup successful');
    }
}

