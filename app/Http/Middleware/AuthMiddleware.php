<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class AuthMiddleware
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
        if ((session('user-data')) != null) {
            if (session('user-data')->role == 'Admin') {
                return redirect()->to(url('user'));
            } else {
                switch (session('user-data')->role) {
                    case 'Eselon 3':
                        return redirect()->to(url('eselon-tiga'));
                        break;
                    case 'Eselon 4':
                        return redirect()->to(url('eselon-empat'));
                        break;
                    case 'Pranata':
                        return redirect()->to(url('pranata'));
                        break;
                    case 'Konseptor':
                        return redirect()->to(url('konseptor'));
                        break;
                }
            }
        }
        return $next($request);
    }
}
