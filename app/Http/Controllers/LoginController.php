<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class LoginController extends Controller
{
    //

    public function formLogin(){
        return view('login');
    }

    public function formRegister(){
        return view('register');
    }

    public function loginAction(Request $request){
        $request->validate([
            "email"=>'required',
            "password"=>'required'
        ]);

        $user = $request->input("email");
        $pass = $request->input("password");
        $cek = 0;
        $selecteduser = null;

        if($user == "master" && $pass == "master"){
            Session::put('role', 'master');

            return redirect(url('/masteruser'));
        }
        else if (Auth::attempt(["email" =>$user, "password" => $pass])) {
            # code...
            // Alert::success("Berhasil", " Login email");

            // return back();
            $cek = 1;

        }
        else if(Auth::attempt(["username" =>$user, "password" => $pass])){
            // Alert::success("Berhasil", " Login username");
            // return back();
            $cek = 1;
        }
        else{
            Alert::error("Gagal", "Gagal Login");
            return back();
        }

        if ($cek == 1) {
            # code...
            $selecteduser = DB::table('users')->where("username",'=',$user)->orWhere("email",'=',$user)->first();
            // dd($selecteduser->email_verified_at);
            Session::put('role', $selecteduser->role);
                Session::put('user',$selecteduser);
            if ($selecteduser->email_verified_at != null) {
                # code...
                // Alert::success("Berhasil", " email sudah verif");
                // return back();



                if ($selecteduser->role == "customer") {
                    # code...
                    return redirect(url('/'));
                }
                else if ($selecteduser->role == "admin") {
                    # code...
                    return redirect(url('/admin'));
                }
                else{

                }
            }
            else{

                return redirect()->route('verification.notice');
            }

        }

    }

    public function registerAction(Request $request){

        $request->validate([
            "username"=>"required",
            "email"=>"required",
            "password"=>['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $cek = DB::table('users')->where("username","=", $request->username)->first();
        $cek2 = DB::table('users')->where("email","=", $request->email)->first();
        // $cek = DB::table('users')->get();
        // var_dump($cek);


        if ($cek !=null) {
            # code...
            Alert::error("Gagal", "Username sudah terpakai");
            // toast("username sudah terpakai", "error");
            return redirect()->back();
            // return back()->with("success", "username sudah terpakai");

        }
        else if($cek2 != null){
            Alert::error("Gagal", "Email sudah terpakai");
            // toast("username sudah terpakai", "error");
            return redirect()->back();
        }
        else{

            $result = User::create([
                "username"=> $request->username,
                "email"=> $request->email,
                "password"=> password_hash($request->password,PASSWORD_DEFAULT),
                "role" => "customer",
                "status" => "buyer",
            ]);

            event(new Registered($result));

            $result->sendEmailVerificationNotification();
            Auth::login($result);

            Alert::success("Email ", "$request->email");
            return redirect(url("/verify"))->with("email", $request->email);
        }

    }


    public function verification(EmailVerificationRequest $r){

        $r->fulfill();

        $link = url("/");
        return response()->view("Email.HEmailDone")->withHeaders(["Refresh"=>"4;url=$link"]);
    }




}
