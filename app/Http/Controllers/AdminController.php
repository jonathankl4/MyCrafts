<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    //
    public function homepage(){

        // return view("admin.userlog",["user"])
        $user = Session::get("user");

        return view("admin.dashboard", ['user'=>$user]);
        // dd($user);
    }
}
