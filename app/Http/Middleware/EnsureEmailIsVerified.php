<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureEmailIsVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    { 
        if (! $request->user() || ! $request->user()->email_verified_at) {
            return redirect()->route('verification.notice')
                ->with('message', 'Silakan verifikasi email Anda terlebih dahulu.');
        }
        return $next($request);
    }
}
