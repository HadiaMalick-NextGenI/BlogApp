<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect('/login')->with('error', 'You do not have permission to access this page.');
        }

        $user = Auth::user();

        if ($user->hasRole('admin')) {
            return $next($request);
        }

        if ($user->hasRole('editor')) {
            if ($request->isMethod('post') && $request->is('users') || 
                $request->isMethod('delete') && $request->is('users/*') || 
                $request->is('users/create')) {
                return redirect()->back()->with('error', 'You do not have permission to perform this action.');
            }

            return $next($request);
        }

        return redirect()->back()->with('error', 'You do not have permission to access this page.');
    }

}
