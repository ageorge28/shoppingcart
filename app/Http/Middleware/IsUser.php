<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class IsUser
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
        if (Auth::check()) {
            if(auth()->user()->is_admin == 0){
                return $next($request);
            }
            else
            {
                Auth::guard('web')->logout();

                $request->session()->invalidate();
        
                $request->session()->regenerateToken();
                
                return redirect(route('login'));
            }
        }
        else{
            return redirect()->route('login');
        }
    }
}
