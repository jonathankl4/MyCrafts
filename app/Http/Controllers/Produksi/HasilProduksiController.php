<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\HasilProduksi;
use App\Models\RencanaProduksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;

use function Laravel\Prompts\table;

class HasilProduksiController extends Controller
{
    //

    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }


    public function pageInputHasilProduksi(){

        $user = $this->getLogUser();

        $rp = DB::table('rencana_produksis')->where('id_toko','=',$user->id_toko)->where('status','=',2)->get();

        return view("seller.produksi.hasilproduksi.inputHasilProduksi", ["user"=>$user,"listProduksi"=>$rp]);
    }

    public function getRencanaProduksi(Request $request){

        if ($request->ajax()) {
            # code...
            $rp = RencanaProduksi::find($request->id);

            // error_log($rp);

            return response()->json($rp);

        }

    }


    public function addHasilProduksi(Request $request){

        $user = $this->getLogUser();



        $request->validate([
            'listProduksi' => 'required',
            'jumlahBerhasil' => 'required',
            'jumlahGagal' =>'required',
        ],

        ["required" => ":attribute harus di isi !",
        "integer" => ":attribute harus berupa angka !"]);



        $rp = RencanaProduksi::find($request->listProduksi);





        $h = new HasilProduksi();
        $h->id_toko = $user->id_toko;
        $h->id_bom = $rp->id_bom; // fix needed
        $h->nama_produk = $request->namaProduk;
        $h->jumlah_diproduksi = $request->jumlahProduksi;
        $h->jumlah_berhasil = $request->jumlahBerhasil;
        $h->jumlah_gagal = $request->jumlahGagal;
        $h->durasi = $request->durasi;
        $h->id_produksi = $rp->id;
        $h->save();



            // storeAs akan menyimpan default ke local


        toast('Berhasil Input Hasil Produksi', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect()->back();

    }

    public function riwayatInputHasilProduksi(){

        $user = $this->getLogUser();

        $riwayat = DB::table('hasil_produksis')->join('rencana_produksis','hasil_produksis.id_produksi','=','rencana_produksis.id')->where("hasil_produksis.id_toko",'=',$user->id_toko)->get();

        // dd($riwayat);

        return view('seller.produksi.hasilproduksi.riwayatInputHasilProduksi',['user'=>$user, 'listRiwayat'=>$riwayat]);
    }
}
