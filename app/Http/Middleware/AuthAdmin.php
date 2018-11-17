<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use SWAL;

class AuthAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (Auth::user()->level == 'user') {
            Swal::message('Opss..', 'Access Denied!', 'error');
            return redirect()->to('/');
        }
        return $next($request);
    }
}
