<?php

namespace App\Http\Controllers\produksi;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PenggunaanBahanController extends Controller
{
 
    //
    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function pageAddPenggunaanBahan(){

        $user = $this->getLogUser();

        


        return view("seller.produksi.penggunaanBahan.tambahPenggunaanBahan", ["user"=>$user]);
    }




}
