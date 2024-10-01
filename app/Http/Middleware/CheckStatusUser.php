<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStatusUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $s = session()->get('user');

        $user = User::find($s->id);

        if ($user != null) {
            # code...
            $stat = $user->status;
            if ($stat == "buyer") {
                # code...

                return redirect(route('daftarseller'));
            }
        }
        else{
            return redirect(url('/'));
        }




        // dd($user);

        return $next($request);
    }
}
