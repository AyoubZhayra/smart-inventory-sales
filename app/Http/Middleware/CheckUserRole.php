<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();
        
        if (!$user) {
            return redirect()->route('login');
        }
        
        // Check if the user is an admin (admins can access everything)
        if ($user->isAdmin()) {
            return $next($request);
        }
        
        // Check the user role against the allowed roles
        foreach ($roles as $role) {
            if ($role === 'manager' && $user->isManager()) {
                return $next($request);
            } elseif ($role === 'staff' && $user->isStaff()) {
                return $next($request);
            }
        }
        
        // Redirect based on user's role if not authorized
        if ($user->isManager()) {
            return redirect()->route('manager.dashboard')->with('error', 'You do not have permission to access this page.');
        } else {
            return redirect()->route('staff.dashboard')->with('error', 'You do not have permission to access this page.');
        }
    }
}
