<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
    'name',
    'matric_no',
    'staff_id', // Added this
    'email',
    'password',
    'is_admin', // Added this
];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
{
    return [
        'matric_no' => 'string',
        'staff_id' => 'string',
        'password' => 'hashed',
        'is_admin' => 'boolean', // Ensures 1/0 from DB becomes true/false in PHP
    ];
}

    public function login(Request $request)
{
    $credentials = $request->validate([
        'matric_no' => ['required', 'string'],
        'password' => ['required'],
    ]);

    // This handles BOTH admin and user because both use matric_no
    if (Auth::attempt($credentials, $request->filled('remember'))) {
        $request->session()->regenerate();

        // Check if the authenticated person is an Admin
        if (Auth::user()->is_admin) {
            return redirect()->intended('/admin/reports'); 
        }

        // Otherwise, they are a normal user
        return redirect()->intended('/profile');
    }

    return back()->withErrors([
        'matric_no' => 'The provided credentials do not match our records.',
    ])->withInput();
}
}
