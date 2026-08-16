<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) {
            return redirect()->route('admin.login')->with('warning', 'Silakan masuk terlebih dahulu untuk mengakses panel admin.');
        }

        $user = Auth::user();
        $allowedRoles = ['superadmin', 'admin', 'author'];

        if (!in_array($user->role, $allowedRoles, true)) {
            Auth::logout();
            return redirect()->route('admin.login')->with('error', 'Akses ditolak. Akun Anda tidak memiliki izin administrator.');
        }

        return $next($request);
    }
}
