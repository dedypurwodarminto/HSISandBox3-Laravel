<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string  $role
     * @return mixed
     */
    public function handle($request, Closure $next, $role){
        if (Auth::check()) {
            // Jika user tidak memiliki role yang diinginkan, tampilkan pesan kesalahan
            return $next($request);
        }
        return redirect('/')->with('error', 'Anda tidak memiliki akses untuk halaman ini.');
    }
}
