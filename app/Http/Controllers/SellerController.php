<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    //

    public function getLogUser()
    {
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }


    public function homePage(){
        $user = Session::get("user");

        return view("seller.dashboard", ['user'=>$user]);
    }


    public function membershipPage(){

        $user = $this->getLogUser();

        return view('seller.membership', ['user'=>$user]);

    }



}
