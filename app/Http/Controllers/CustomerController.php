<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use stdClass;

class CustomerController extends Controller
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

    public function homePage(){

        // return view("admin.userlog",["user"])
        $user = $this->getLogUser();

        return view("customer.shopping.dashboard", ['user'=>$user]);
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
