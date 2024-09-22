<?php

namespace App\Http\Controllers;

use App\Models\ProdukCustom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use stdClass;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    //
    public function getUserLog(){
        $user = new stdClass();
        $user->username = "master";
        $user->email = "master";
        $user->role = "master";

        return $user;
    }

    public function homepage(){

        // return view("admin.userlog",["user"])
        $user = $this->getUserLog();
        
        // dd($user);
        return view("admin.dashboard", ['user'=>$user]);
        // dd($user);
    }
    public function lemari1(){

        $user = $this->getUserLog();

        return view('admin.produkcustom.lemari.lemari1',["user"=>$user]);
    }


    public function lemari2(){

        $user = $this->getUserLog();

        return view('admin.produkcustom.lemari.lemari2',["user"=>$user]);
    }
    public function lemari3(){

        $user = $this->getUserLog();

        return view('admin.produkcustom.lemari.lemari3',["user"=>$user]);
    }

    // Route::get('/',[AdminController::class, "homepage"]);
    // Route::get('/produkCustom/tambahProdukCustom',[AdminController::class,'tambahProdukCustom']);
    // Route::get('/produkCustom/daftarProdukCustom',[AdminController::class,'daftarProdukCustom']);
    // Route::get('/produkCustom/templateProduk',[AdminController::class, 'templateProduk']);
    // Route::get('/produkCustom/addOn',[AdminController::class,'listAddOn']);


    public function tambahProdukCustom(){

        $user = $this->getUserLog();

        return view('');
    }

    public function daftarProdukCustom(){

        $user = $this->getUserLog();

        $daftarProduk = DB::table('produk_customs')->get();

        return view('admin.daftarProdukCustom',['user'=>$user,'listProduk'=>$daftarProduk]);
    }

    public function tambahTemplate(Request $request){
        

        $foto = "";
        $namaFileGambar = "";

        $namaFolder = "fotoTemplateMaster/";

        $foto = $request->file('foto');
        $namaFileGambar = Str::random(8).".".$foto->getClientOriginalExtension();
        $foto->storeAs($namaFolder,$namaFileGambar,'public');

        $t = new ProdukCustom();
        $t->nama_template = $request->namaTemplate;
        $t->harga = $request->harga;
        $t->foto = $namaFileGambar;
        $t->save();
        toast("Berhasil tambah Template");

        return redirect()->back();
        
    }
    public function listAddOn(){
        
        $user = $this->getUserLog();
        $daftarAddOn = DB::table('');
    }
}
