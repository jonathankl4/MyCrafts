<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\tester;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
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

        return view("customer.dashboard", ['user'=>$user]);

    }

    public function testmid(){
        return view("trans");
    }

    public function testbayar($id){

        $data = Donation::find($id);

        return view('bayar',['data'=>$data]);
    }

    public function carimax(){

        $input = "jojo";

        $panjang = strlen($input);
        $hasil = "";
        $temp = now();

        dd($temp);



    }


    public function testingfabric(){

        $user = $this->getLogUser();

        return view('seller.produkCustom.produk.CobaCustomH1', ['user'=>$user]);
    }

    public function uploadImage(Request $request){

        $imageData = $request->image;

        //buat nama file unik
        $fileName = uniqid(). '.png';

        //hapus prefix 'data:image/png;base64,'
        $imageData = str_replace('data:image/png;base64','',$imageData);
        $imageData = str_replace(' ','+',$imageData);

        $image = base64_decode($imageData);

        $filePath = 'public/hasilcustom/'. $fileName;
        Storage::put($filePath,$image);

        $n = new tester();
        $n->isi1 = $fileName;
        $n->save();

        return response()->json(['success' =>true,'file_path'=>$filePath]);

    }

    public function beli(Request $request){
        $imageData = $request->image;

        //buat nama file unik
        $fileName = uniqid(). '.png';

        //hapus prefix 'data:image/png;base64,'
        $imageData = str_replace('data:image/png;base64','',$imageData);
        $imageData = str_replace(' ','+',$imageData);

        $image = base64_decode($imageData);

        $filePath = 'public/hasilcustom/'. $fileName;
        Storage::put($filePath,$image);

        $n = new tester();
        $n->isi2 = $fileName;
        $n->save();

        return response()->json(['success' =>true,'file_path'=>$filePath]);
    }


    public function testingLemari1(){

        $user = $this->getLogUser();
        return view('seller.produkCustom.produk.testinglemari1',['user'=>$user]);
    }


}
