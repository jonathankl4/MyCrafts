<?php

namespace App\Http\Controllers;

use App\Models\Produk;
use App\Models\ProdukDijual;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukController extends Controller
{
    //


    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function pageDaftarProduk(){

        $user = $this->getLogUser();
        $produk = DB::table('produk_dijuals')->where("id_toko",'=',$user->id_toko)->get();

        return view('seller.produk.daftarProduk',['user'=>$user, 'listProduk'=>$produk]);
    }

    public function pageAddProduk(){
        $user = $this->getLogUser();
        $satuan = DB::table('satuans')->where("id_toko",'=',$user->id_toko)->get();
        return view('seller.produk.tambahProduk', ['user'=>$user, 'satuan'=>$satuan]);

    }



    public function pageEditProduk($id){
        $user = $this->getLogUser();
        $satuan = DB::table('satuans')->where("id_toko",'=',$user->id_toko)->get();
        $produk = ProdukDijual::find($id);
        return view('seller.produk.editProduk', ['user'=>$user, 'satuan'=>$satuan, 'produk'=>$produk]);
    }


    public function deleteProduk($id){

        $produk = ProdukDijual::find($id);

        $path1 = public_path('storage/imgProduk/'.$produk->foto_produk1);
        $path2 = public_path('storage/imgProduk/'.$produk->foto_produk2);
        $path3 = public_path('storage/imgProduk/'.$produk->foto_produk3);
        $path4 = public_path('storage/imgProduk/'.$produk->foto_produk4);
        if ($produk->foto_produk1 != null && file_exists($path1)) {
            # code...
            unlink(public_path('storage/imgProduk/'.$produk->foto_produk1));
        }
        if ($produk->foto_produk2 != null && file_exists($path2)) {
            # code...
            unlink(public_path('storage/imgProduk/'.$produk->foto_produk2));
        }
        if ($produk->foto_produk3 != null && file_exists($path3)) {
            # code...
            unlink(public_path('storage/imgProduk/'.$produk->foto_produk3));
        }
        if ($produk->foto_produk4 != null && file_exists($path4)) {
            # code...
            unlink(public_path('storage/imgProduk/'.$produk->foto_produk4));
        }
        $produk->delete();

        toast('berhasil hapus produk', 'success');
        return redirect()->back();

    }

    public function addProduk(Request $request){
        $user = $this->getLogUser();

        $toko = toko::find($user->id_toko);

        $foto1 = "";
        $foto2 = "";
        $foto3 = "";
        $foto4 = "";
        $namaFileGambar1  = "";
        $namaFileGambar2  = "";
        $namaFileGambar3  = "";
        $namaFileGambar4  = "";

        $produk = DB::table('produk_dijuals')->where('id_toko', $user->id_toko)->count();
        if ($toko->status == 'Free') {
            # code...
            if ($produk >= 3) {
                # code...
                Alert::error('', 'beli membership untuk menambahkan produk lebih dari 5');

                return redirect()->back();
            }
        }

        $p = new ProdukDijual();
        $p->id_toko = $user->id_toko;
        $p->nama_produk = $request->namaProduk;

        $p->harga_produk = $request->hargaProduk;
        $p->jumlah_produk = $request->jumlahProduk;
        $p->ukuran = $request->ukuran;
        $p->bahan = $request->bahan;

        $p->keterangan_produk = $request->keteranganProduk;

        $p->status = "nonaktif";

        $namaFolderPhoto = "imgProduk/";

            // storeAs akan menyimpan default ke local
        if ($request->file('fotoUtama') != null) {
            # code...
            $foto1 = $request->file("fotoUtama");
            $namaFileGambar1  = Str::random(8).".".$foto1->getClientOriginalExtension();
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar1, 'public');
        }

        if ($request->file('fotoProduk2') != null) {
            # code...
            $foto2 = $request->file("fotoProduk2");
            $namaFileGambar2  = Str::random(8).".".$foto2->getClientOriginalExtension();
            $foto2->storeAs($namaFolderPhoto,$namaFileGambar2, 'public');
        }
        if ($request->file('fotoProduk3') != null) {
            # code...
            $foto3 = $request->file("fotoProduk3");
            $namaFileGambar3  = Str::random(8).".".$foto3->getClientOriginalExtension();
            $foto3->storeAs($namaFolderPhoto,$namaFileGambar3, 'public');
        }
        if ($request->file('fotoProduk4') != null) {
            # code...
            $foto4 = $request->file("fotoProduk4");
            $namaFileGambar4  = Str::random(8).".".$foto4->getClientOriginalExtension();
            $foto4->storeAs($namaFolderPhoto,$namaFileGambar4, 'public');
        }

        $p->foto_produk1 = $namaFileGambar1;
        $p->foto_produk2 = $namaFileGambar2;
        $p->foto_produk3 = $namaFileGambar3;
        $p->foto_produk4 = $namaFileGambar4;
        $p->save();
        toast('Berhasil tambah Produk', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect(url('/seller/produk/daftarProduk'));
    }

    public function ubahStatusProduk(Request $request){

        $produk = ProdukDijual::find($request->idProduk);
        // error_log($produk);
        $produk->status = $request->status;
        $produk->save();
        // toast('Berhasil Ubah Status', 'success');
        // error_log($request->status);
        // dd($produk);
    }

    public function editProduk(Request $request, $id){

        $request->validate([
            "namaProduk"=>'required',
            "hargaProduk"=>'required',
            "jumlahProduk"=>'required',
            "ukuran"=>'required',
            "bahan"=>'required',
            "keteranganProduk"=>'required',


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

        $m = ProdukDijual::find($id);
        $m->nama_produk = $request->namaProduk;

        $m->harga_produk = $request->hargaProduk;
        $m->jumlah_produk = $request->jumlahProduk;
        $m->ukuran = $request->ukuran;
        $m->bahan = $request->bahan;

        $m->keterangan_produk = $request->keteranganProduk;


        $namaFolderPhoto = "imgProduk/";

        if ($request->file("fotoUtama")!= null) {
            # code...
            if ($m->foto_produk1 != null) {
                # code...
                $image_path = public_path('storage/imgProduk/'.$m->foto_produk1);
                unlink($image_path);
            }

            $foto1 = $request->file("fotoUtama");
            $namaFileGambar1  = Str::random(8).".".$foto1->getClientOriginalExtension();
            $m->foto_produk1 = $namaFileGambar1;
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar1, 'public');
        }

        if ($request->file("fotoProduk2") != null) {
            # code...
            if ($m->foto_produk2 != null) {
                # code...

                $image_path = public_path('storage/imgProduk/'.$m->foto_produk2);
                unlink($image_path);
            }
            $foto2 = $request->file("fotoProduk2");
            $namaFileGambar2  = Str::random(8).".".$foto2->getClientOriginalExtension();
            $m->foto_produk2 = $namaFileGambar2;
            $foto2->storeAs($namaFolderPhoto,$namaFileGambar2, 'public');
        }

        if ($request->file("fotoProduk3") != null) {
            # code...
            if ($m->foto_produk3 != null) {
                # code...

                $image_path = public_path('storage/imgProduk/'.$m->foto_produk3);
                unlink($image_path);
            }
            $foto3 = $request->file("fotoProduk3");
            $namaFileGambar3  = Str::random(8).".".$foto3->getClientOriginalExtension();
            $m->foto_produk3 = $namaFileGambar3;
            $foto3->storeAs($namaFolderPhoto,$namaFileGambar3, 'public');
        }

        if ($request->file("fotoProduk4") != null ) {
            # code...
            if ($m->foto_produk4 != null) {
                # code...
                $image_path = public_path('storage/imgProduk/'.$m->foto_produk4);
                unlink($image_path);

            }
            $foto4 = $request->file("fotoProduk4");
            $namaFileGambar4  = Str::random(8).".".$foto4->getClientOriginalExtension();
            $m->foto_produk4 = $namaFileGambar4;
            $foto4->storeAs($namaFolderPhoto,$namaFileGambar4, 'public');
        }

        $m->save();
        // dd($satuan);
        toast('Berhasil edit Produk', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect('/seller/produk/daftarProduk');
    }


}
