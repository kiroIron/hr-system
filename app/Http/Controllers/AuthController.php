<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //

    public function register( Request $request){
        $data = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'password' => 'required|confirmed',
            'role' => 'in:admin,employee',
        ]);

        // Set default role to 'admin' if not provided in the request
        $userData = array_merge($data, ['role' => $data['role'] ?? 'employee']);


        // Mass assign the validated request data to a new instance of the User model
        $user = User::create($userData);
        $token = $user->createToken('my-token')->plainTextToken;

        return response()->json([
            'token' =>$token,
            'Type' => 'Bearer'
        ]);
    }

    public function login(Request $request)
    {
        $fields = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = User::where('email', $fields['email'])->first();

        if (!$user || !Hash::check($fields['password'], $user->password)) {
            return response([
                'message' => 'Wrong credentials'
            ]);
        }

        $token = $user->createToken('my-token')->plainTextToken;

        // return response()->json([
        //     'token' => $token,
        //     'Type' => 'Bearer',
        //     'role' => $user->role // include user role in response
        // ]);

        // Log the user in
        Auth::login($user);

    

        // Redirect based on the user role
        if ($user->role == 'admin') {
            // Redirect to admin route if user is admin
            return redirect()->route('pages.hr.dashboard');
        } else if ($user->role == 'employee') {
            // Redirect to employee route if user is an employee
            return redirect()->route('pages.employee.dashboard');
        }

        // Fallback if no valid role
        return redirect()->route('pages.login')->with('error', 'Unauthorized access');
    }


    public function logout(Request $request)
{
    // Revoke all tokens for the authenticated user
    $user = Auth::user();

    if ($user) {
        $user->tokens()->delete();;
        Auth::logout(); // Log the user out from the session
    }

    // Redirect to the login page with a success message
    return redirect()->route('pages.login')->with('success', 'Logged out successfully.');
}
    public function show(){
        return " All users are shown here";
    }
    public function update(Request $request , $id){
        return " All updates on users are done here";
        }
}