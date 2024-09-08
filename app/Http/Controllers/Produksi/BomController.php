<?php

namespace App\Http\Controllers\Produksi;

use App\Http\Controllers\Controller;
use App\Models\Bahan;
use App\Models\Bom;
use App\Models\BomDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class BomController extends Controller
{
    //
    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function pageBOM(){

        $user = $this->getLogUser();
        $bom = DB::table("boms")->where("id_toko",'=',$user->id_toko)->get();

        return view("seller.produksi.billOfMaterial.bom", ['user'=>$user, 'listBom'=>$bom]);
    }

    public function pageAddBom(){
        $user = $this->getLogUser();

        return view("seller.produksi.billOfMaterial.tambahBom", ['user'=>$user]);
    }

    public function addBom(Request $request){
        $user = $this->getLogUser();
        // dd($user);
        

        $b = new Bom();
        $b->id_toko = $user->id_toko;
        $b->nama_product = $request->namaProduk;
        $b->total_biaya = 0;
        $b->save();
        // dd($satuan);
        toast('Berhasil tambah Bom', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/produksi/bom');

    }

    public function deleteBom($id){
        $act1 = DB::table("bom_details")->where('id_bom','=',$id)->delete();
        $act2 = DB::table("boms")->where("id",'=',$id)->delete();
        if ($act2) {
            # code...
            // Alert::success("", "Berhasil hapus");
            toast('Berhasil hapus', 'success');
            return redirect()->back();
        }

    }

    public function pageEditBom($id){
        $user = $this->getLogUser();
        $bom = Bom::find($id);

        return view("seller.produksi.billOfMaterial.editBom",['user'=>$user, 'bom'=>$bom]);

    }

    public function editBom(Request $request, $id){
        $user = $this->getLogUser();
        // dd($user);
        
        $b = Bom::find($id);
        $b->nama_product = $request->namaProdukEdit;
        $b->save();
        // dd($satuan);
        toast('Berhasil Edit Bom', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/produksi/bom');
    }

    public function pageDetailBom($id){
        $user = $this->getLogUser();
        $bom = DB::table("boms")->where("id",'=',$id)->first();
        // dd($bom->nama_product);
        $detailBom = DB::table("bom_details")->join('bahans','bom_details.id_bahan','=','bahans.id')->where('id_bom','=',$bom->id)->get();
        // $detailBom = [];
        // dd($detailBom);
        return view("seller.produksi.billOfMaterial.detailBom", ['user'=>$user, 'bom'=>$bom,'listDetail'=>$detailBom]);

    }

    public function pageAddDetailBom($id){
        $user = $this->getLogUser();

        $bom = DB::table("boms")->where("id",'=',$id)->first();
        $bahan = DB::table('bahans')->where("id_toko",'=',$user->id_toko)->get();
        return view("seller.produksi.billOfMaterial.tambahDetailBom",['user'=>$user, 'bom'=>$bom, 'listBahan'=>$bahan]);


    }

    public function addDetailBom(Request $request, $id){
        $user = $this->getLogUser();
        // dd($user);
        $request->validate([
            "namaBahan"=>'required',

        ],

        ["required" => ":attribute tidak boleh kosong"]);

        $b = new BomDetail();
        $b->id_bom = $id;
        $b->id_bahan = $request->bahan;
        $b->keterangan = $request->keterangan;
        $b->jumlah = $request->jumlah;
        
        
        $b->subtotal = $request->subtotal;
        $b->save();

        //untuk update total biaya
        $bom = Bom::find($id);
        $total = $bom->total_biaya;
        $bom->total_biaya = $total+$request->subtotal;
        $bom->save();

        // dd($satuan);
        toast('Berhasil tambah Detail Bom', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/pDetailBom/'.$id);
    }

    public function pageEditDetailBom($id){

        $user = $this->getLogUser();
        $bom = BomDetail::find($id);

        return view('seller.produksi.billOfMaterial.editDetailBom', ['user'=>$user, 'bom'=>$bom]);
    }

    public function editDetailBom(Request $request, $id){
        $request->validate([
            "namaBahan"=>'required',

        ],

        ["required" => ":attribute tidak boleh kosong"]);

        $b = BomDetail::find($id);
        $tempsubtotal = $b->subtotal;
        $b->nama_bahan = $request->namaBahan;
        $b->deskripsi = $request->deskripsi;
        $b->jumlah = $request->jumlah;
        $b->ukuran = $request->ukuran;
        $b->harga = $request->hargaBahan;
        $b->subtotal = $request->subtotal;
        $b->save();

        $bom = Bom::find($b->id_bom);
        $total = $bom->total_biaya;
        $bom->total_biaya = $total+$request->subtotal-$tempsubtotal;
        $bom->save();
        // dd($satuan);
        toast('Berhasil Ubah Detail Bom', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/pDetailBom/'.$b->id_bom);
    }

    public function deleteDetailBom($id){
        $bd = BomDetail::find($id);

        $b = Bom::find($bd->id_bom);
        $total = $b->total_biaya;
        $b->total_biaya = $total-$bd->subtotal;
        $b->save();

        $act = DB::table("bom_details")->where('id','=',$id)->delete();

        if ($act) {
            # code...
            // Alert::success("", "Berhasil hapus");
            toast('Berhasil hapus', 'success');
            return redirect()->back();
        }
    }

    public function getBahan(Request $request){


        if ($request->ajax()) {
            # code...

            $bahan = Bahan::find($request->id);

            return response()->json($bahan);
        }

    }
}
