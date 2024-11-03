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
            "noTelpSupplier"=>'required|integer',
        ],

        ["required" => ":attribute tidak boleh kosong",
        "integer" => ":attribute harus berupa angka"]);

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
        $satuan = DB::table('satuans')->where("id_toko",'=',$user->id_toko)->get();

        return view("seller.master.bahan.editBahan", ['user'=>$user, 'bahan'=>$bahan, 'satuan'=>$satuan]);
    }


    public function addBahan(Request $request){
        $user = $this->getLogUser();
        // dd($user);
        $request->validate([
            "namaBahan"=>'required',

            "jumlahBahan"=>'required',


            "hargaBahan"=>'required',

        ],

        ["required" => ":attribute harus di isi!"]);

        $panjang = 0;
        $lebar = 0 ;
        $tinggi = 0 ;
        if ($request->ukuranPanjang != null) {
            # code...
            $panjang = $request->ukuranPanjang;
        }
        if ($request->ukuranLebar != null) {
            # code...
            $lebar = $request->ukuranLebar;
        }
        if ($request->ukuranTinggi != null) {
            # code...
            $tinggi = $request->ukuranTinggi;
        }

        $b = new Bahan();
        $b->id_toko = $user->id_toko;
        $b->nama_bahan = $request->namaBahan;
        $b->ukuran_bahan = $request->ukuranBahan;
        $b->satuan_bahan = $request->satuanBahan;
        $b->jumlah_bahan = $request->jumlahBahan;
        $b->ukuran_panjangBahan = $panjang;
        $b->ukuran_lebarBahan = $lebar;
        $b->ukuran_tinggiBahan = $tinggi;
        $b->harga_bahan = $request->hargaBahan;
        $b->satuan_jumlah = $request->satuanJumlah;
        $b->save();
        // dd($satuan);
        toast('Berhasil tambah Bahan', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/master/bahan');
    }

    public function deleteBahan($id){
        $act = DB::table("bahans")->where('id','=',$id)->delete();

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

            "jumlahBahan"=>'required',

            "hargaBahan"=>'required',

        ],

        ["required" => ":attribute harus di isi!"]);

        $panjang = 0;
        $lebar = 0 ;
        $tinggi = 0 ;
        if ($request->ukuranPanjang != null) {
            # code...
            $panjang = $request->ukuranPanjang;
        }
        if ($request->ukuranLebar != null) {
            # code...
            $lebar = $request->ukuranLebar;
        }
        if ($request->ukuranTinggi != null) {
            # code...
            $tinggi = $request->ukuranTinggi;
        }
        $b = Bahan::find($id);

        $b->nama_bahan = $request->namaBahan;
        $b->ukuran_bahan = $request->ukuranBahan;
        $b->satuan_bahan = $request->satuanBahan;
        $b->jumlah_bahan = $request->jumlahBahan;
        $b->ukuran_panjangBahan = $panjang;
        $b->ukuran_lebarBahan = $lebar;
        $b->ukuran_tinggiBahan = $tinggi;
        $b->harga_bahan = $request->hargaBahan;
        $b->satuan_jumlah = $request->satuanJumlah;
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

        $request->validate([
            'namaMebel' => 'required',
            'tipeMebel' => 'required',
            'hargaMebel' => 'required',
            'jumlahMebel' => 'required',
            'ukuranPanjang' => 'required',
            'ukuranTinggi' => 'required',
            'ukuranLebar' => 'required',
            'satuanMebel' => 'required',
            'keteranganMebel' => 'required',



        ],

        ["required" => ":attribute harus di isi !"]);






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

        $m->save();



            // storeAs akan menyimpan default ke local


        toast('Berhasil tambah Mebel', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect(url('/seller/master/mebel'));

    }

    public function editMebel(Request $request, $id){
        $request->validate([
            'namaMebel' => 'required',
            'tipeMebel' => 'required',
            'hargaMebel' => 'required',
            'jumlahMebel' => 'required',
            'ukuranPanjang' => 'required',
            'ukuranTinggi' => 'required',
            'ukuranLebar' => 'required',
            'satuanMebel' => 'required',
            'keteranganMebel' => 'required',

        ],

        ["required" => ":attribute tidak boleh kosong"]);







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


        $m->save();
        // dd($satuan);
        toast('Berhasil edit Mebel', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/master/mebel');
    }


}
