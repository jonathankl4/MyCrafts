<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\HasilProduksi;
use App\Models\RencanaProduksi;
use App\Models\User;
use DateTime;
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

    public function addHasilProduksi(Request $request){

        // dd($request);
        $user = $this->getLogUser();

        



        $rp = RencanaProduksi::find($request->id_produksi);
        $rp->status = 2;
        $rp->tgl_produksi_selesai = now();

        $time1 = new DateTime($rp->tgl_produksi_mulai);
        $time2 = new DateTime('now');

        $selisih = $time1->diff($time2);
        $rp->waktu_produksi = $selisih->days;
        $rp->save();

        

        $h = new HasilProduksi();
        $h->id_toko = $user->id_toko;
        $h->id_produksi = $request->id_produksi;
        $h->jumlah_berhasil = $request->jumlahBerhasil;
        $h->jumlah_gagal = $request->jumlahGagal;
        $h->durasi = $selisih->days;
        $h->keterangan = $request->keterangan;
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
