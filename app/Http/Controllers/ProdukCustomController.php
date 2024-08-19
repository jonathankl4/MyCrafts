<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProdukCustomController extends Controller
{
    //

    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }



    // halaman daftar template
    public function pageTemplateProduk(){
        $user = $this->getLogUser();
        $template = [];
        return view("seller.produkCustom.daftarTemplate", ['user'=>$user, 'listTemplate'=>$template]);

    }

    public function pageTambahTemplate(){
        $user = $this->getLogUser();
        return view("seller.produkCustom.tambahTemplate", ['user'=>$user]);
    }


    // halaman tambah produk custom
    public function pageAddCustomProduk(){
        $user = $this->getLogUser();
        $satuan = DB::table('satuans')->where("id_toko",'=',$user->id_toko)->get();
        return view('seller.produkCustom.tambahProdukCustom', ['user'=>$user, 'satuan'=>$satuan]);

    }


}
