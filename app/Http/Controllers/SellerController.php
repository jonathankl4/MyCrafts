<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Pegawai;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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

    public function getToko()
    {
        $user = $this->getLogUser();

        $toko = toko::find($user->id_toko);
        return $toko;
    }


    public function homePage(){
        $user = $this->getLogUser();

        $toko = $this->getToko();

        return view("seller.dashboard", ['user'=>$user, 'toko'=>$toko]);


    }





    public function pegawaiPage(){

        $user = $this->getLogUser();
        $toko = $this->getToko();

        $pegawai = DB::table('pegawais')
                        ->leftJoin('users', 'pegawais.id_user', '=', 'users.id')
                        ->where('pegawais.id_toko', $toko->id)
                        ->select('pegawais.*', 'users.email')
                        ->get();
        // dd($pegawai);
        return view('seller.pegawai', ['user'=> $user, 'listPegawai'=>$pegawai]);

    }

    public function addPegawai(Request $request){

        $user = DB::table('users')->where('email', $request->email)->first();
        $toko = $this->getToko();

        if ($user) {
            # code...
            if ($user->status == 'owner') {
                # code...
                toast('user sudah terdaftar sebagai seller', 'error');
                return redirect()->back();
            }
            else {
                if ($user->status != 'buyer') {
                    # code...
                    toast('user sedang bekerja di toko lain', 'error');
                    return redirect()->back();
                }
                else if ($user->status == 'buyer') {
                    # code...

                    $p = new Pegawai();
                    $p->id_user = $user->id;
                    $p->id_toko = $toko->id;
                    $p->role = $request->role;
                    $p->save();

                    $u = User::find($user->id);
                    $u->status = 'pegawai-'.$request->role;
                    $u->id_toko = $toko->id;
                    $u->save();
                    toast('User Berhasil ditambahkan', 'success');
                    return redirect()->back();
                }
            }
        }
        else{
            toast('user tidak ditemukan', 'error');
            return redirect()->back();
        }
    }

    public function editPegawai(Request $request, $id){

        $pegawai = Pegawai::find($id);
        $pegawai->role = $request->role;
        $pegawai->save();

        $user = User::find($pegawai->id_user);
        $user->status ='pegawai-'.$request->role;
        $user->save();

        toast('Berhasil ubah role', 'success');
        return redirect()->back();
    }

    public function deletePegawai($id){

        $pegawai = Pegawai::find($id);

        $user = User::find($pegawai->id_user);
        $user->status = 'buyer';
        $user->id_toko = null;
        $user->save();

        $pegawai->delete();
        toast('Berhasil hapus pegawai', 'success');
        return redirect()->back();


    }



}
