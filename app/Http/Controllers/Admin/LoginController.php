<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){

    return view('admin.auth.login');
    }

    // Handle login
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt login
        if (Auth::attempt($request->only('email', 'password'))) {

            // Redirect to dashboard
            return redirect()->route('admin.dashboard');
        }

        return back()->with('error', 'Invalid Email or Password');
    }

    // Logout
    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
