<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\RencanaProduksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PerencanaanProduksiController extends Controller
{
    //
    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function pagePerencanaanProduksi(){

        $user = $this->getLogUser();
        $pp = DB::table('rencana_produksis')->where('id_toko','=',$user->id_toko)->get();

        return view("seller.produksi.perencanaanProduksi.perencanaanProduksi", ['user'=>$user, 'listProduksi'=>$pp]);
    }
}
