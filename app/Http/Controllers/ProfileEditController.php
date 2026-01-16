<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileEditController extends Controller
{
    /**
     * Show the profile edit page
     */
    public function edit()
    {
        $user = Auth::user(); // Get current logged-in user
        return view('profileedit', compact('user')); // Load Blade and pass user
    }

    /**
     * Update the user profile
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:8|confirmed', // optional password
        ]);

        // Update user data
        $user->name = $request->name;
        $user->email = $request->email;

        // Update password if provided
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        // Redirect back to profile page with a success message
        return redirect()->route('profile')->with('success', 'Profile updated successfully!');
    }

    /**
     * Delete the user account
     */
    public function destroy()
    {
        $user = Auth::user();
        Auth::logout(); // log out user
        $user->delete(); // delete account

        return redirect('/')->with('success', 'Account deleted successfully!');
    }
}

