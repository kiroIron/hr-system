<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $role)
    {
        // Check if user is authenticated and has the required role
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request); // Allow the request to proceed
        }

        // Redirect if the user does not have the correct role
        return redirect('/');
    }
}