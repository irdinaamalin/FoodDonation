<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('login');
    }

    public function login(Request $request)
    {
        // We validate 'matric_no' as the input field name from your form
        $request->validate([
            'matric_no' => ['required', 'string'], 
            'password' => ['required'],
        ]);

        $loginId = $request->input('matric_no');
        $password = $request->input('password');
        $remember = $request->filled('remember');

        // 1. Attempt login as Student (matric_no)
        $loginStudent = Auth::attempt(['matric_no' => $loginId, 'password' => $password], $remember);
        
        // 2. Attempt login as Staff/Admin (staff_id)
        $loginStaff = Auth::attempt(['staff_id' => $loginId, 'password' => $password], $remember);

        if ($loginStudent || $loginStaff) {
            $request->session()->regenerate();

            // Check if the authenticated user is an Admin
            if (Auth::user()->is_admin) {
                return redirect()->intended('/admin/reports'); 
            }

            // Otherwise, redirect to normal user profile
            return redirect()->intended('/profile');
        }

        return back()->withErrors([
            'matric_no' => 'The provided credentials do not match our records.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
