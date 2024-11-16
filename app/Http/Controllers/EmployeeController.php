<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    // Display the form to create a new employee
    public function create()
    {
        // Fetch all teams from the database to populate the team dropdown
        $teams = Team::all();
        $users = User::all(); // Fetch all users (you can also add filters if necessary)

        // Return the create employee view with teams data
        return view('pages.hr.create_employee', compact('teams' ,'users'));
    }

    // Store the new employee in the database
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8',
            'team_id' => 'required|exists:teams,id',
        ]);

        // Create a new employee (user) in the database
        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'team_id' => $validated['team_id'],
            
        ]);

        // Redirect back to the employee creation page with a success message
        return redirect()->route('pages.hr.create_employee')->with('success', 'Employee created successfully!');
    }
}
