<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SellerController extends Controller
{
    //


    public function homePage(){
        $user = Session::get("user");

        return view("seller.dashboard", ['user'=>$user]);
    }



}
