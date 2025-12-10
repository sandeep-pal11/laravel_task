<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RoleMiddleware
{
    public function handle($request, Closure $next, $role)
    {
        //  If user not logged in
        if (!Auth::check()) {
            return redirect()->route('login.page')
                ->with('error', 'Please login first!');
        }

        // Logged in user role slug (super-admin, admin, customer)
        $userRole = Auth::user()->role->slug;

        //  If unauthorized role access
        if ($userRole !== $role) {
            return redirect()->back()
                ->with('error', 'You are not authorized!');
        }

        return $next($request);
    }
}
