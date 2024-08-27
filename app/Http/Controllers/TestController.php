<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use stdClass;

class TestController extends Controller
{
    //

    public function getLogUser(){
        $user = new stdClass();
        $s = Session::get("user");
        if ($s!= null) {
            # code...
            $user = User::find($s->id);


        }
        else {
            $user->username = "Guest";
            $user->email = "Guest";
            $user->role = "guest";
        }

        return $user;


    }

    public function coba(){


        $user = $this->getLogUser();

        return view("customer.shopping.dashboard", ['user'=>$user]);

    }

    public function testmid(){
        return view("trans");
    }

    public function testbayar(){

        $data = Donation::find(42);

        return view('bayar',['data'=>$data]);
    }

    public function carimax(){

        $input = "jojo";

        $panjang = strlen($input);
        $hasil = "";
        $temp = str_split($input, 1);

        dd($temp);



    }


    public function testingfabric(){

        $user = $this->getLogUser();

        return view('seller.produkCustom.produk.testing', ['user'=>$user]);
    }


}
