<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, string $role): Response
    {
        $user = $request->user();

        // Inclusive Role Logic:
        // 1. Admin/Superadmin can access EVERYTHING
        // 2. Vendors can access User routes
        // 3. Perfect match always wins
        $hasAccess = $user && (
            $user->role === $role || 
            $user->isAdmin() || 
            ($role === 'user' && $user->isVendor())
        );

        if (!$hasAccess) {
            if ($user) {
                // Prevent redirection loop: only redirect if not already on the correct dashboard
                if ($user->isAdmin() && !$request->is('admin/*')) {
                    return redirect()->route('admin.dashboard');
                }
                if ($user->isVendor() && !$request->is('mitra/*')) {
                    return redirect()->route('mitra.pesanan');
                }
                if ($user->role === 'user' && !$request->is('dashboard*')) {
                    return redirect()->route('dashboard');
                }
            }
            return redirect()->route('login');
        }

        return $next($request);
    }
}
