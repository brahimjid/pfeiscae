<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        //dd($guard);
        switch ($guard){
            case "medecin":
                if (Auth::guard($guard)->check()) {
                    return redirect()->route("medecinIndex");
                }
                break;
            case "structure":
                if (Auth::guard($guard)->check()) {
                    return redirect(route("structureIndex"));
                }
                break;
                case "admin":
                if (Auth::guard($guard)->check()) {
                    return redirect(route("adminIndex"));
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
            return redirect(RouteServiceProvider::HOME);
           }
                break;
        }
//        if (Auth::guard($guard)->check()) {
//            return redirect(RouteServiceProvider::HOME);
//        }

        return $next($request);
    }
}
