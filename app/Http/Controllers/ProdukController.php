<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    //


    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }


    public function pageDaftarProduk(){

        $user = $this->getLogUser();
        $produk = DB::table('produk_dijuals')->where("id_toko",'=',$user->id_toko)->get();

        return view('seller.produk.daftarProduk',['user'=>$user, 'listProduk'=>$produk]);
    }

    public function pageTambahProduk(){
        $user = $this->getLogUser();
        $satuan = DB::table('satuans')->where("id_toko",'=',$user->id_toko)->get();
        return view('seller.produk.tambahProduk', ['user'=>$user, 'satuan'=>$satuan]);



    }


}
