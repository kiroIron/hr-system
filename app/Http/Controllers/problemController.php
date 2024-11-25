<?php

namespace App\Http\Controllers;

use App\Models\m_problem;
use App\Models\User;
use Illuminate\Http\Request;

class problemController extends Controller
{
    /**
     * Display the problem submission page with a list of problems.
     */
    public function employeeProblem()
    {
        // Get all problems and eager-load the user relationship
        $problems = m_problem::with('user')->get();

        return view('pages.employee.employee_problem', compact('problems'));
    }

    /**
     * Store a new problem in the database.
     */
    public function storeProblem(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        // Store the problem
        m_problem::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'user_id' => auth()->id(), // Assign the logged-in user's ID
        ]);

        // Redirect back with a success message
        return redirect()->route('employeeproblem')->with('success', 'Problem submitted successfully!');
    }
}
