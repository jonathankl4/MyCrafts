<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class checklog
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session()->has('role')) {
            # code...
            if (session()->get('role') == "admin" ){
                return redirect('/admin');
            }else if(session()->get('role')== "customer"){
                return redirect('/');
            } else if(session()->get('role')== "master"){
                return redirect('/masteruser');
            }
            else{
                // return redirect('/admin');
            }

        }
        return $next($request);
    }
}
