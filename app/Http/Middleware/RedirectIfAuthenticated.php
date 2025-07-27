<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RedirectIfAuthenticated
{
  public function handle(Request $request, Closure $next, string $guard = null): Response
{
    try {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user && $user->hasRole('admin')) {
                return redirect()->route('admin_dashboard');
            } elseif ($user && $user->hasRole('user')) {
                return redirect()->route('user_dashboard');
            }

            // Role not found or broken session – logout safely
            Auth::logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect()->route('login')->with('error', 'Session expired or unauthorized role.');
        }
    } catch (\Exception $e) {
        // Catch unexpected session or auth issues
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login')->with('error', 'Your session was invalid or expired.');
    }

    return $next($request);
}

}
