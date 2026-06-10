<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckSubscription
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = auth()->user();

        // If not a vendor, just pass (handled by role middleware usually)
        if (!$user->isVendor()) {
            return $next($request);
        }

        // Check for active subscription
        $hasActiveSub = \App\Models\Subscription::where('vendor_id', $user->id)
            ->where('status_pembayaran', 'verified')
            ->where('expiry_date', '>', now())
            ->exists();

        if (!$hasActiveSub) {
            // Redirect to a specialized page or back with error
            return redirect()->route('dashboard')
                ->with('error', 'Keanggotaan Mitra Anda tidak aktif atau sudah kadaluarsa. Silakan lakukan pembayaran perpanjangan (Rp 250.000/bulan).');
        }

        return $next($request);
    }
}
