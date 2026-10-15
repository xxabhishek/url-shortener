<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($data)) {
            return redirect('/short-urls');
        }

        return back()->with('error', 'Invalid email or password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
