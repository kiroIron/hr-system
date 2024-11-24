<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class sittingController extends Controller
{
    /**
     * Show the profile settings view.
     */
    public function profileSitting()
    {
        $user = Auth::user();
        return view('pages.employee.employee_profile_sitting', compact('user'));
    }

    /**
     * Update the profile.
     */
    public function updateProfile(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'birthday' => 'nullable|date',
            'address' => 'nullable|string|max:255',
        ]);

        // Handle the profile image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('uploads/profile_images'), $imageName);
            $user->image = '/uploads/profile_images/' . $imageName;
        }

        $user->birthday = $request->birthday;
        $user->address = $request->address;

        $user->save();

        return redirect()->route('profile.sitting')->with('success', 'Profile updated successfully!');
    }
}
