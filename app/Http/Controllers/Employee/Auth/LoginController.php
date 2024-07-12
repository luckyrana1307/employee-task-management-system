<?php

namespace App\Http\Controllers\Employee\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('employee.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('employee')->attempt($credentials)) {
            return redirect()->intended(route('employee.dashboard'));
        }

        return back()->withErrors(['email' => 'Email or password are incorrect']);
    }

    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.auth.login');
    }
}