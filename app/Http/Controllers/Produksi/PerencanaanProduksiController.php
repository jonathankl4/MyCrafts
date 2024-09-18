<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\Bom;
use App\Models\BomDetail;
use App\Models\HasilProduksi;
use App\Models\PenggunaanBahan;
use App\Models\RencanaProduksi;
use App\Models\User;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class PerencanaanProduksiController extends Controller
{
    //
    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function pagePerencanaanProduksi(){

        // date_default_timezone_set('Asia/Jakarta');
        $time = now();

        // dd($time);
        $user = $this->getLogUser();
        $pp = DB::update('update rencana_produksis set status = 1 where tgl_produksi_mulai <= CURRENT_DATE and status=0');
        $pp = DB::update('update rencana_produksis set status = 0 where tgl_produksi_mulai > CURRENT_DATE and status=1');
        $pp = DB::table('rencana_produksis')->where('id_toko','=',$user->id_toko)->where('status','=',0)->orWhere('status','=',1)->get();


        return view("seller.produksi.perencanaanProduksi.perencanaanProduksi", ['user'=>$user, 'listProduksi'=>$pp]);
    }


    public function pageAddProduksi(){

        $user = $this->getLogUser();

        $bom = DB::table('boms')->where('id_toko', '=', $user->id_toko)->get();


        return view("seller.produksi.perencanaanProduksi.tambahproduksi", ["user"=>$user, 'listBom'=>$bom]);
    }


    public function addProduksi(Request $request){
        $user = $this->getLogUser();

        $request->validate([

            'billOfMaterial' => 'required',
            'tglProduksi' => 'required',
            'jumlahProduksi' => 'required|integer',
        ],

        ["required" => ":attribute harus di isi !",
        "integer" => ":attribute harus berupa angka !"]);



       $bom = Bom::find($request->billOfMaterial);



        $p = new RencanaProduksi();
        $p->id_toko = $user->id_toko;
        $p->tgl_produksi_mulai = $request->tglProduksi;
        $p->nama_produk = $bom->nama_product;
        $p->jumlahdiproduksi = $request->jumlahProduksi;
        $p->status = 0;
        $p->id_bom = $bom->id;


        $p->save();

        $kodeproduksi = "PRO".substr($request->namaProduk, 0, 3).$request->jumlahProduksi.$p->id;
        $p->kode_produksi = $kodeproduksi;
        $p->save();


            // storeAs akan menyimpan default ke local


        toast('Berhasil tambah rencana produksi', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect(url('/seller/produksi/perencanaanProduksi'));

    }

    public function pageDetailProduksi($id){

        $user = $this->getLogUser();
        $produksi = RencanaProduksi::find($id);
        $bom = Bom::find($produksi->id_bom);
        $detail = DB::table('bom_details')->join('bahans','bahans.id','=','bom_details.id_bahan')->where('id_bom','=',$bom->id)->get();
        

        $s = $produksi->status;
        $status = "";
        $color = "";
        if($s == 0){
            $status = "Belum Dimulai";
            $color = "bg-info";
        }
        else if($s == 1){
            $status = "Dalam proses";
            $color = "bg-warning";
        }
        else if($s == 3){
            $status = "DiBatalkan";
            $color = "bg-danger";
        }
        else {
            $status = "Selesai";
            $color = "bg-success";
        }
        
        // dd($produksi);


        return view('seller.produksi.perencanaanProduksi.detailRencanaProduksi',['user'=>$user, 'produksi'=> $produksi, 'listDetail'=>$detail, 'bom'=> $bom, 'status'=>$status,'color'=>$color]);
    }

    public function pageEditProduksi($id){

        $user = $this->getLogUser();
        $produksi = RencanaProduksi::find($id);

        $tgl =Carbon::parse($produksi->tgl_produksi)->format('m/d/y');

        return view("seller.produksi.perencanaanProduksi.editRencanaProduksi", ['user'=>$user, 'produksi'=>$produksi, 'tgl'=>$tgl]);
    }
    public function editProduksi(Request $request, $id){
        $user = $this->getLogUser();

        

        dd($request);



        $p = RencanaProduksi::find($id);
        $p->id_toko = $user->id_toko;
        $p->tgl_produksi_mulai = $request->tglProduksi;
        
        $p->jumlahdiproduksi = $request->jumlahProduksi;

        $p->save();

        $pp = DB::update('update rencana_produksis set status = 1 where tgl_produksi_mulai <= CURRENT_DATE and status=0');
        $pp = DB::update('update rencana_produksis set status = 0 where tgl_produksi_mulai > CURRENT_DATE and status=1');



            // storeAs akan menyimpan default ke local


        toast('Berhasil Simpan Perubahan', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect()->back();
        
    }

    public function batalkanProduksi($id){
        $produksi = RencanaProduksi::find($id);

        $produksi->status = 3;
        $produksi->save();

        toast('Produksi '.$produksi->nama_produk .' berhasil dibatalkan');
        return redirect()->back();
    }
    


    public function getBom(Request $request){

        if ($request->ajax()) {
            # code...
            $bom = Bom::find($request->id);

            // error_log($request->id);

            return response()->json($bom);

        }
    }


    public function pageRiwayatProduksi(){



        $user = $this->getLogUser();

        // $riwayat = DB::table('hasil_produksis')->join('rencana_produksis','rencana_produksis.id','=','hasil_produksis.id_produksi')->where('hasil_produksis.id_toko','=',$user->id_toko)->get();
        $riwayat = DB::table('rencana_produksis')->leftJoin('hasil_produksis','hasil_produksis.id_produksi','=','rencana_produksis.id')->where('rencana_produksis.id_toko','=',$user->id_toko)->where('status','=',2)->orWhere('status','=',3)->get();
        // dd($riwayat);

        return view('seller.produksi.perencanaanProduksi.riwayatProduksi',['user'=>$user,'listRiwayat'=>$riwayat]);

        

    }

    public function pagePenyelesaianProduksi($id){

        $user = $this->getLogUser();
        $produksi = RencanaProduksi::find($id);
        $bom = Bom::find($produksi->id_bom);
        $detail = DB::table('bom_details')->join('bahans','bahans.id','=','bom_details.id_bahan')->where('id_bom','=',$bom->id)->get();

        // dd($detail);
        return view('seller.produksi.perencanaanProduksi.selesaikanProduksi',['user'=>$user, 'produksi'=>$produksi,'listBahan'=>$detail]);


    }

    public function simpanHasilProduksi(Request $request){
         
         $user = $this->getLogUser();

        
        // dd($request->namabahan[0]);


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


         for ($i=0; $i < count($request->id_bahan) ; $i++) { 
            # code...
            $bahan = new PenggunaanBahan();
            $bahan->id_produksi = $request->id_produksi;
            $bahan->id_bahan = $request->id_bahan[$i];
            $bahan->nama_bahan = $request->namabahan[$i];
            $bahan->jumlah_penggunaan = $request->jumlah[$i];
            $bahan->save();
         }
         
             // storeAs akan menyimpan default ke local
 
 
         toast('Berhasil Input Hasil Produksi', 'success');
         // Alert::success('','berhasil tambah satuan');
         return redirect()->back();
    }

    

    

    
}
