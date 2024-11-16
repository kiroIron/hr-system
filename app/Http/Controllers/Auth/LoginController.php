<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    // Show the login form
    public function showLoginForm()
    {
        return view('pages.login');
    }

    // Handle the login request
    public function login(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'email' => 'required|string',
            'password' => 'required|string',
        ]);

        // Hardcoded credentials
        $adminEmail = 'admin@admin.com';
        $adminPassword = 'admin';

        // Check for the default admin credentials first
        if ($request->email === $adminEmail && $request->password === $adminPassword) {
            // Manually create a dummy user object with 'admin' role (no DB interaction)
            $user = new User();
            $user->id = 1; // Unique user ID
            $user->email = $adminEmail;
            $user->role = 'admin'; // Role for the user (no need to save this in DB)
            
            // Log the user in
            Auth::login($user); // Use Auth::login() instead of loginUsingId()

            // Store the user role in session (optional)
            Session::put('user', $user); // This is optional, but useful for other data
// Log session and authentication status for debugging
// Log session and authentication status for debugging
// Log::info('Session:', session()->all()); // Log all session data
// Log::info('User Authenticated:', [Auth::check()]); // Check if the user is authenticated

            // Redirect to HR dashboard
            return redirect()->route('pages.hr.dashboard');
        }

        // If not admin, check the database for other users
        $user = User::where('email', $request->email)->first();

        if ($user && Hash::check($request->password, $user->password)) {
            // If the user exists and the password is correct, log the user in
           
            $user->role = 'employee'; // Role for the user (no need to save this in DB)
           // In the LoginController
Auth::login($user);

// Store the user in session if you still want this for some reason (Laravel usually handles this by default)
Session::put('user', $user);
            // Redirect to employee dashboard
            return redirect()->route('pages.employee.dashboard');
        }

        // If login fails, redirect back with an error
        return back()->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    // Handle logout
    public function logout(Request $request)
    {
        Auth::logout(); // Logs out the user
        return redirect('/');
    }
}
