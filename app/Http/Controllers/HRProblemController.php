<?php

namespace App\Http\Controllers;

use App\Models\m_problem;
use Illuminate\Http\Request;

class HRProblemController extends Controller
{
    /**
     * Display a list of problems sent by employees.
     */
    public function viewProblems()
    {
        // Fetch all problems and eager-load the user relationship
        $problems = m_problem::with('user')->get();

        // Pass the data to the HR view
        return view('pages.hr.message_problem', compact('problems'));
    }
}

