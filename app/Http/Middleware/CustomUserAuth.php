<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class CustomUserAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // if(!auth()->guard('customUserAuth')->check()){
        //     Alert::error("Gagal", "login dulu kimak");
        //     return redirect(route('login'));
        // }

        // return $next($request);

        $s = session()->get('user');

        $user = User::find($s->id);

        if($user != null){
            if ($user->is_activated != 1) {
                # code...
                return redirect()->route('verification.notice');
            }
        }
        else{
            return redirect(url('/'));
        }



        // if (! $request->user() ||
        //     ($request->user() instanceof MustVerifyEmail &&
        //     ! $request->user()->hasVerifiedEmail())) {
        //     return $request->expectsJson()
        //             ? abort(403, 'Your email address is not verified.')
        //             : Redirect::guest(URL::route($redirectToRoute ?: 'verification.notice'));
        // }

        return $next($request);
    }
}
