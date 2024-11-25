<?php 

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class employeeTaskController extends Controller
{
    // Display tasks assigned to the employee
    public function employeeTask()
    {
        $employeeTeamId = Auth::user()->team_id; // Retrieve the team_id from the authenticated employee

        // Fetch tasks related to the employee's team
        $tasks = Task::where('team_id', $employeeTeamId)->get();

        return view('pages.employee.employee_task', compact('tasks'));
    }

    // Mark a task as 'end'
    public function endTask($id)
    {
        $task = Task::findOrFail($id);

        // Ensure only tasks with 'pending' status can be updated
        if ($task->status == 'pending') {
            $task->update(['status' => 'end']);
        }

        // Redirect back with a success message
        return redirect()->route('employeeTask')->with('success', 'Task status updated successfully!');
    }
}
