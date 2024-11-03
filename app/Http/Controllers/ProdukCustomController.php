<?php

namespace App\Http\Controllers;

use App\Models\AddOn;
use App\Models\DetailAddonDijual;
use App\Models\DetailProdukCustomDijual;
use App\Models\ProdukCustomDijual;
use App\Models\Template;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukCustomController extends Controller
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
    // START OF PRODUK CUSTOM


    // halaman tambah produk custom
    public function pageAddCustomProduk()
    {
        $user = $this->getLogUser();

        $daftarproduk = DB::table('produk_customs')->get();
        return view('seller.produkCustom..produk.tambahProdukCustom', ['user' => $user, 'listProduk' => $daftarproduk]);
    }

    public function pageDaftarProdukCustom()
    {

        $user = $this->getLogUser();

        $daftarproduk = DB::table('produk_custom_dijuals')->where('id_toko', '=', $user->id_toko)->where('deleted', 0)->get();

        return view('seller.produkCustom.produk.daftarProdukCustom', ['user' => $user, 'daftarProduk' => $daftarproduk]);
    }

    public function ubahStatusProduk(Request $request)
    {

        $produk = ProdukCustomDijual::find($request->idProduk);
        // error_log($produk);
        $produk->status = $request->status;
        $produk->save();
        // toast('Berhasil Ubah Status', 'success');
        // error_log($request->status);
        // dd($produk);
    }

    public function pageDetailProdukCustom($id)
    {

        $user = $this->getLogUser();

        $produk = ProdukCustomDijual::find($id);
        $detailKayu = DetailProdukCustomDijual::where('id_produk_custom_dijual', $id)->get();
        $detailAddon = DetailAddonDijual::where('id_produk_custom_dijual', $id)->get();

        if ($produk->nama_template == "Lemari 1") {
            # code...


            // Kirim data ke view
            return view('seller.produkCustom.produk.detailLemari1', [
                'user' => $user,
                'detailKayu' => $detailKayu,
                'detailAddon' => $detailAddon
            ]);
        } else if ($produk->nama_template == "Lemari 2") {

            return view('seller.produkCustom.produk.detailLemari2', [
                'user' => $user,
                'detailKayu' => $detailKayu,
                'detailAddon' => $detailAddon
            ]);
        } else if ($produk->nama_template == "Lemari 3") {

            return view('seller.produkCustom.produk.detailLemari3', [
                'user' => $user,
                'detailKayu' => $detailKayu,
                'detailAddon' => $detailAddon
            ]);
        }
    }


    public function editDetailProduk(Request $request)
    {

        $produk = ProdukCustomDijual::find($request->idProduk);

        $produk->nama_produk = $request->namaProduk;
        $produk->deskripsi = $request->deskripsi;
        $produk->panjang_min = $request->panjangMin;
        $produk->panjang_max = $request->panjangMax;
        $produk->tinggi_min = $request->tinggiMin;
        $produk->tinggi_max = $request->tinggiMax;
        $produk->lebar_min = $request->lebarMin;
        $produk->lebar_max = $request->lebarMax;

        $produk->save();

        toast('Detail Produk Berhasil diubah', 'success');
        return redirect()->back();
    }


    public function deleteProdukCustom($id){

        $produk = ProdukCustomDijual::find($id);
        $produk->deleted = 1;
        $produk->status = 'nonaktif';

        $produk->save();

        toast('berhasil hapus produk custom', 'success');
        return redirect()->back();
    }









    // END OF PRODUK CUSTOM


}
