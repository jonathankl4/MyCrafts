<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class CustomerController extends Controller
{
    //


    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);

        return $user;
    }

    public function homePage(){

        // return view("admin.userlog",["user"])
        $user = $this->getLogUser();

        return view("customer.dashboard", ['user'=>$user]);
        // dd($user);
    }


    public function daftarSeller(){



        $user = $this->getLogUser();

        if ($user->status == "owner") {
            # code...
            return redirect('/seller');
        }



        return view("seller.regseller", ['user'=>$user]);


    }

    public function becomeSeller(){



        $user = $this->getLogUser();


        $user->status = "owner";
        $user->save();

        $toko = new toko();
        $toko->id_owner = $user->id;
        $toko->nama = $user->username;
        $toko->save();


        $user->id_toko = $toko->id;
        $user->save();



        Alert::success('Berhasil menjadi Seller', '');

        return redirect(url('/seller'));







    }
}
