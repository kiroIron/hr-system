<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Team;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Show the task creation form
    public function create()
    {
        // Get all teams to display in the form
        $teams = Team::all();
        $tasks = Task::with('team')->get(); // Load tasks with team info
        return view('pages.hr.create_task', compact('teams', 'tasks'));
    }

    // Store a new task in the database
    public function store(Request $request)
    {
        // Validate the incoming data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'status' => 'required|in:pending,end',
            'team_id' => 'required|exists:teams,id', // Ensure the team exists
        ]);

        // Create the task
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'status' => $request->status,
            'team_id' => $request->team_id,
        ]);

        // Redirect back with a success message
        return redirect()->route('pages.hr.create_task')->with('success', 'Task created successfully!');
    }
}
