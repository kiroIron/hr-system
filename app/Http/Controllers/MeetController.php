<?php

namespace App\Http\Controllers;

use App\Models\Meet;
use Illuminate\Http\Request;

class MeetController extends Controller
{
    /**
     * Show the meeting creation form.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $meets = Meet::all(); // Retrieve all meetings
        return view('pages.hr.message_meeting', compact('meets'));
    }
    

    /**
     * Store the meeting in the database.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validate the form data
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'date_time' => 'required|date',
        ]);

        // Create a new meeting record
        Meet::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'date_time' => $request->date_time,
        ]);

        // Redirect back with a success message
        return redirect()->route('message_meeting')->with('success', 'Meeting added successfully!');
    }
    public function employeeMeetings()
{
    // Retrieve all meetings to show to employees
    $meets = Meet::all();

    // Pass data to the view
    return view('pages.employee.employee_meeting', compact('meets'));
}
/**
 * Delete a meeting (HR only).
 *
 * @param int $id
 * @return \Illuminate\Http\RedirectResponse
 */
public function destroy($id)
{
    $meeting = Meet::findOrFail($id);
    $meeting->delete();

    return redirect()->route('message_meeting')->with('success', 'Meeting deleted successfully!');
}

}

