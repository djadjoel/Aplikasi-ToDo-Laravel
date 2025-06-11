<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticatedToDashboard
{
    public function handle(Request $request, Closure $next): Response
    {
        // ✅ Hanya redirect jika SUDAH login
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            //return redirect('/default/login'); // atau route('beranda')
        }

        return $next($request); // ✅ Biarkan lewat kalau belum login
    }
}
