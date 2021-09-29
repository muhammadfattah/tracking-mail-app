<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (!session('user-data')) {
            return redirect()->to(url(''));
        } else if (session('user-data')->role == 'Admin') {
            return redirect()->to(url('user'));
        } else if (session('user-data')->role == 'Eselon 3' && ($request->segment(1) != 'eselon-tiga')) {
            return redirect()->to(url('eselon-tiga'));
        } else if (session('user-data')->role == 'Eselon 4' && ($request->segment(1) != 'eselon-empat')) {
            return redirect()->to(url('eselon-empat'));
        } else if (session('user-data')->role == 'Pranata' && ($request->segment(1) != 'pranata')) {
            return redirect()->to(url('pranata'));
        } else if (session('user-data')->role == 'Konseptor' && ($request->segment(1) != 'konseptor')) {
            return redirect()->to(url('konseptor'));
        }
        return $next($request);
    }
}
