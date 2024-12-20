<?php

namespace App\Http\Middleware;

use App\Models\toko;
use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Response;

class ProOnly
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
        $toko = toko::find($user->id_toko);

        if ($toko->status == "Free") {
            # code...
            toast('Daftar Membership Pro terlebih dahulu', 'info');
            return redirect('/seller/membership');
        }


        return $next($request);
    }
}
