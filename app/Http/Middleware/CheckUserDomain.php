<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckUserDomain
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $domain)
    {
        // Ambil email pengguna yang sedang login
        $userEmail = $request->user()->email;

        // Cek apakah domain email mengandung domain yang ditentukan
        if (!str_ends_with($userEmail, '@' . $domain)) {
            abort(403, 'Access denied');
        }

        return $next($request);
    }
}
