<?php

namespace App\Http\Controllers;

use App\Models\m_holiday;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class MHolidayController extends Controller
{
    // Constructor to ensure authentication and authorization
    public function __construct()
    {
        // Protect HR views by ensuring only HR can access them
        $this->middleware('auth');
        $this->middleware('restrictRole:admin')->only(['hrView', 'updateHolidayAction']);
    }

    // Show the holiday request form (Employee View)
    public function create(Request $request)
    {
        $user = $request->user();
        // Fetch the authenticated user's holidays
        $holidays = m_holiday::where('user_id', $user->id)->get(); // Fetch employee's holidays

        return view('pages.employee.message_holiday', compact('holidays'));
    }

    // Store a new holiday request (Employee submits the form)
    public function store(Request $request)
    {
        $user = $request->user(); // Get the authenticated user
    
        // Validate the request data
        $request->validate([
            'subject' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
        ]);
    
        // Create the holiday request
        m_holiday::create([
            'subject' => $request->subject,
            'description' => $request->description,
            'date' => $request->date,
            'action' => 'pending', // Default to 'pending'
            'user_id' => $user->id, // Use the authenticated user's ID
        ]);
    
        // Redirect back with a success message
        return redirect()->route('pages.employee.message_holiday')
            ->with('success', 'Holiday request submitted successfully!');
    }
    
    

    // Show HR's view with options to accept or cancel holidays
    public function hrView()
    {
        // Get all holiday requests for HR
        $holidays = m_holiday::all();

        // Return the HR holiday request view
        return view('pages.hr.message_holiday', compact('holidays'));
    }

    // Accept or Cancel Holiday (HR action)
    public function updateHolidayAction($id, $action)
    {
        // Find the holiday request by ID
        $holiday = m_holiday::findOrFail($id);

        // Check if the action is valid (only 'accepted' or 'cancelled' are allowed)
        if (!in_array($action, ['accept', 'cancel'])) {
            return redirect()->route('pages.hr.message_holiday')
                ->with('error', 'Invalid action. Only accepted or cancelled are allowed.');
        }
        
        // Update the action field (either 'accepted' or 'cancelled')
        $holiday->action = $action;
        $holiday->save();

        // Redirect back with a success message
        return redirect()->route('pages.hr.message_holiday')
            ->with('success', 'Holiday request updated successfully!');
    }
}
