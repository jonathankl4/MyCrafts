<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\Mebel;
use App\Models\satuan;
use App\Models\supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;

class MasterController extends Controller
{
    //

    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }


    // Satuan
    public function pageMasterSatuan(){
        $s = Session::get("user");
        $user = User::find($s->id);
        $satuan = DB::table("satuans")->where("id_toko",'=',$user->id_toko)->get();
        // dd($satuan);
        return view("seller.master.Satuan", ['user'=>$user, 'listSatuan'=>$satuan]);
    }
    public function addSatuan(Request $request){

        $user = $this->getLogUser();
        // dd($user);
        $request->validate([
            "namaSatuan"=>'required',
        ],

        ["required" => ":attribute tidak boleh kosong"]);

        $satuan = new satuan();
        $satuan->id_toko = $user->id_toko;
        $satuan->nama_satuan = $request->namaSatuan;
        $satuan->save();
        // dd($satuan);
        toast('Berhasil tambah satuan', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect()->back();

    }
    public function deleteSatuan($id){

        $act = DB::table("satuans")->where('id','=',$id)->delete();

        if ($act) {
            # code...
            // Alert::success("", "Berhasil hapus");
            toast('Berhasil hapus', 'success');
            return redirect()->back();
        }
    }
    public function editSatuan(Request $request, $id){
        $isibtn = $request->btnsimpan;

        Session::put('idedit', $isibtn);

        $request->validate([
            "editSatuan"=>'required',
        ],

        ["required" => "nama satuan tidak boleh kosong"]);

        $s = satuan::find($id);
        // dd($s);
        $s->nama_satuan = $request->editSatuan;
        $s->save();
        toast('Berhasil Edit', 'success');
        return redirect()->back();
    }


    // Supplier
    public function pageMasterSupplier(){

        $s = Session::get("user");
        $user = User::find($s->id);
        $supplier = DB::table("suppliers")->where("id_toko",'=',$user->id_toko)->get();
        return view("seller.master.supplier", ['user'=>$user, 'listSupplier'=>$supplier]);
    }

    public function pageAddSupplier(){
        $s = Session::get("user");
        $user = User::find($s->id);

        return view("seller.master.tambahSupplier", ['user'=>$user]);
    }

    public function addSupplier(Request $request){

        $user = $this->getLogUser();
        // dd($user);
        $request->validate([
            "namaSupplier"=>'required',
            "noTelpSupplier"=>'required',
        ],

        ["required" => ":attribute tidak boleh kosong"]);

        $s = new supplier();
        $s->id_toko = $user->id_toko;
        $s->nama_sup = $request->namaSupplier;
        $s->notelp_sup = $request->noTelpSupplier;
        $s->alamat_sup = $request->alamatSupplier;
        $s->keterangan_sup = $request->ketSupplier;
        $s->save();
        // dd($satuan);
        toast('Berhasil tambah Supplier', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/master/supplier');
    }

    public function deleteSupplier($id){
        $act = DB::table("suppliers")->where('id','=',$id)->delete();

        if ($act) {
            # code...
            // Alert::success("", "Berhasil hapus");
            toast('Berhasil hapus', 'success');
            return redirect()->back();
        }
    }

    public function pageEditSupplier($id){

        $s = Session::get("user");
        $user = User::find($s->id);

        $sup = supplier::find($id);
        // dd($s);

        return view("seller.master.editSupplier", ['user'=>$user, 'sup'=>$sup]);

    }

    public function editSupplier(Request $request, $id){
        $sup = supplier::find($id);

        $request->validate([
            "namaSupplier"=>'required',
            "noTelpSupplier"=>'required',
        ],

        ["required" => ":attribute tidak boleh kosong"]);

        $sup->nama_sup = $request->namaSupplier;
        $sup->notelp_sup = $request->noTelpSupplier;
        $sup->alamat_sup = $request->alamatSupplier;
        $sup->keterangan_sup = $request->ketSupplier;
        $sup->save();

        toast('Berhasil Edit', 'success');
        return redirect(url('/seller/master/supplier'));
    }


    // Bahan
    public function pageMasterBahan(){
        $s = Session::get("user");
        $user = User::find($s->id);
        $bahan = DB::table("bahans")->where("id_toko",'=',$user->id_toko)->get();
        return view("seller.master.bahan.bahan", ['user'=>$user, 'listBahan'=>$bahan]);
    }

    public function pageAddBahan(){
        $s = Session::get("user");
        $user = User::find($s->id);
        $satuan = DB::table('satuans')->where("id_toko",'=',$user->id_toko)->get();

        return view("seller.master.bahan.tambahBahan", ['user'=>$user, 'satuan'=>$satuan]);
    }

    public function pageEditBahan($id){
        $s = Session::get("user");
        $user = User::find($s->id);

        $bahan = Bahan::find($id);

        return view("seller.master.bahan.editBahan", ['user'=>$user, 'bahan'=>$bahan]);
    }


    public function addBahan(Request $request){
        $user = $this->getLogUser();
        // dd($user);
        $request->validate([
            "namaBahan"=>'required',

        ],

        ["required" => ":attribute tidak boleh kosong"]);

        $b = new Bahan();
        $b->id_toko = $user->id_toko;
        $b->nama_bahan = $request->namaBahan;
        $b->ukuran_bahan = $request->ukuranBahan;
        $b->satuan_bahan = $request->satuanBahan;
        $b->jumlah_bahan = $request->jumlahBahan;
        $b->jenis_bahan = $request->jenisBahan;
        $b->harga_bahan = $request->hargaBahan;
        $b->save();
        // dd($satuan);
        toast('Berhasil tambah Bahan', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/master/bahan');
    }

    public function deleteBahan($id){
        $act = DB::table("bahans")->where('id_bahan','=',$id)->delete();

        if ($act) {
            # code...
            // Alert::success("", "Berhasil hapus");
            toast('Berhasil hapus', 'success');
            return redirect()->back();
        }
    }

    public function editbahan(Request $request, $id){
        $request->validate([
            "namaBahan"=>'required',

        ],

        ["required" => ":attribute tidak boleh kosong"]);

        $b = Bahan::find($id);

        $b->nama_bahan = $request->namaBahan;
        $b->ukuran_bahan = $request->ukuranBahan;
        $b->satuan_bahan = $request->satuanBahan;
        $b->jumlah_bahan = $request->jumlahBahan;
        $b->jenis_bahan = $request->jenisBahan;
        $b->harga_bahan = $request->hargaBahan;
        $b->save();
        // dd($satuan);
        toast('Berhasil edit Bahan', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/master/bahan');
    }

    // Mebel or barang jadi

    public function pageMasterMebel(){
        $s = Session::get("user");
        $user = User::find($s->id);
        // $bahan = [];
        $bahan = DB::table("mebels")->where("id_toko",'=',$user->id_toko)->get();
        return view("seller.master.barangJadi.barangJadi", ['user'=>$user, 'listMebel'=>$bahan]);
    }

    public function pageAddMebel(){
        $s = Session::get("user");
        $user = User::find($s->id);
        $satuan = DB::table('satuans')->where("id_toko",'=',$user->id_toko)->get();
        return view("seller.master.barangJadi.tambahMebel", ['user'=>$user, 'satuan'=>$satuan]);
    }


    public function pageEditMebel($id){
        $s = Session::get("user");
        $user = User::find($s->id);
        $mebel = Mebel::find($id);
        $satuan = DB::table('satuans')->where("id_toko",'=',$user->id_toko)->get();
        return view("seller.master.barangJadi.editMebel", ['mebel'=>$mebel, 'user'=>$user, 'satuan'=>$satuan]);
    }

    public function deleteMebel($id){
        $act = DB::table("mebels")->where('id','=',$id)->delete();

        if ($act) {
            # code...
            // Alert::success("", "Berhasil hapus");
            toast('Berhasil hapus', 'success');
            return redirect()->back();
        }
    }

    public function addMebel(Request $request){
        $user = $this->getLogUser();

        $foto1 = "";
        $foto2 = "";
        $foto3 = "";
        $foto4 = "";
        $namaFileGambar1  = "";
        $namaFileGambar2  = "";
        $namaFileGambar3  = "";
        $namaFileGambar4  = "";

        try {
            //code...
            $foto1 = $request->file("fotoMebel1");
            $namaFileGambar1  = Str::random(8).".".$foto1->getClientOriginalExtension();
        } catch (\Throwable $th) {
            //throw $th;
        }


        $m = new Mebel();
        $m->id_toko = $user->id_toko;
        $m->nama_mebel = $request->namaMebel;
        $m->tipe_mebel = $request->tipeMebel;
        $m->harga_mebel = $request->hargaMebel;
        $m->jumlah_mebel = $request->jumlahMebel;
        $m->ukuran_panjangMebel = $request->ukuranPanjang;
        $m->ukuran_lebarMebel = $request->ukuranLebar;
        $m->ukuran_tinggiMebel = $request->ukuranTinggi;
        $m->satuanUkuran_mebel = $request->satuanMebel;
        $m->keterangan_mebel = $request->keteranganMebel;
        $m->foto_mebel1 = $namaFileGambar1;
        $m->foto_mebel2 = $namaFileGambar2;
        $m->foto_mebel3 = $namaFileGambar3;
        $m->foto_mebel4 = $namaFileGambar4;
        $m->save();

        $namaFolderPhoto = "imgMebel/";

            // storeAs akan menyimpan default ke local
        try {
            //code...
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar1, 'public');
        } catch (\Throwable $th) {
            //throw $th;
        }
        try {
            //code...
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar2, 'public');
        } catch (\Throwable $th) {
            //throw $th;
        }
        try {
            //code...
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar3, 'public');
        } catch (\Throwable $th) {
            //throw $th;
        }
        try {
            //code...
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar4, 'public');
        } catch (\Throwable $th) {
            //throw $th;
        }

        toast('Berhasil tambah Mebel', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect(url('/seller/master/mebel'));

    }

    public function editMebel(Request $request, $id){
        $request->validate([


        ],

        ["required" => ":attribute tidak boleh kosong"]);



        $foto1 = "";
        $foto2 = "";
        $foto3 = "";
        $foto4 = "";
        $namaFileGambar1  = "";
        $namaFileGambar2  = "";
        $namaFileGambar3  = "";
        $namaFileGambar4  = "";



        $m = Mebel::find($id);
        $m->nama_mebel = $request->namaMebel;
        $m->tipe_mebel = $request->tipeMebel;
        $m->harga_mebel = $request->hargaMebel;
        $m->jumlah_mebel = $request->jumlahMebel;
        $m->ukuran_panjangMebel = $request->ukuranPanjang;
        $m->ukuran_lebarMebel = $request->ukuranLebar;
        $m->ukuran_tinggiMebel = $request->ukuranTinggi;
        $m->satuanUkuran_mebel = $request->satuanMebel;
        $m->keterangan_mebel = $request->keteranganMebel;


        $m->foto_mebel3 = $namaFileGambar3;
        $m->foto_mebel4 = $namaFileGambar4;

        $namaFolderPhoto = "imgMebel/";

        try {
            //code...
            $foto1 = $request->file("fotoMebel1");
            $namaFileGambar1  = Str::random(8).".".$foto1->getClientOriginalExtension();
            $m->foto_mebel1 = $namaFileGambar1;
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar1, 'public');



        } catch (\Throwable $th) {
            //throw $th;
        }
        try {
            //code...
            $foto2 = $request->file("fotoMebel2");
            $namaFileGambar2  = Str::random(8).".".$foto2->getClientOriginalExtension();
            $m->foto_mebel2 = $namaFileGambar2;
            $foto2->storeAs($namaFolderPhoto,$namaFileGambar2, 'public');
        } catch (\Throwable $th) {
            //throw $th;
        }



        $m->save();
        // dd($satuan);
        toast('Berhasil edit Mebel', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/master/mebel');
    }


}
