<?php

namespace App\Http\Controllers;

use App\Models\AddOn;
use App\Models\DetailAddonDijual;
use App\Models\DetailProdukCustomDijual;
use App\Models\Finishing;
use App\Models\FinishingDijual;
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

        $daftarProduk = [];

        // Data produk
        $data = [
            ['nama' => 'Lemari 1', 'img' => '/img/lemari1/lemari1.png', 'tambahUrl' => '/seller/produkCustom/tambahLemari1', 'modal' => '#modalLemari1', 'tipe' => 'lemari'],
            ['nama' => 'Lemari 2', 'img' => '/img/lemari2/lemari2.png', 'tambahUrl' => '/seller/produkCustom/tambahLemari2', 'modal' => '#modalLemari2', 'tipe' => 'lemari'],
            ['nama' => 'Lemari 3', 'img' => '/img/lemari3/lemari3.png', 'tambahUrl' => '/seller/produkCustom/tambahLemari3', 'modal' => '#modalLemari3', 'tipe' => 'lemari'],
            ['nama' => 'Meja 1', 'img' => '/img/meja1/meja1.png', 'tambahUrl' => '/seller/produkCustom/tambahMeja1', 'modal' => '#modalMeja1', 'tipe' => 'meja'],
            ['nama' => 'Meja 2', 'img' => '/img/meja2/meja2.png', 'tambahUrl' => '/seller/produkCustom/tambahMeja2', 'modal' => '#modalMeja2', 'tipe' => 'meja'],
        ];

        // Masukkan data ke dalam stdClass dan tambahkan ke array daftarProduk
        foreach ($data as $item) {
            $produk = new \stdClass();
            $produk->nama = $item['nama'];
            $produk->img = $item['img'];
            $produk->tambahUrl = $item['tambahUrl'];
            $produk->modal = $item['modal'];
            $produk->tipe = $item['tipe'];
            $daftarProduk[] = $produk;
        }

        return view('seller.produkCustom..produk.tambahProdukCustom', ['user' => $user, 'daftarProduk' => $daftarProduk]);
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
        } else if ($produk->nama_template == "Meja 1") {
            return view('seller.produkCustom.produk.detailMeja1', [
                'user' => $user,
                'detailKayu' => $detailKayu,
                'detailAddon' => $detailAddon
            ]);
        } else if ($produk->nama_template == 'Meja 2') {
            return view('seller.produkCustom.produk.detailMeja2', [
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


    public function deleteProdukCustom($id)
    {

        $produk = ProdukCustomDijual::find($id);
        $produk->deleted = 1;
        $produk->status = 'nonaktif';

        $produk->save();

        toast('berhasil hapus produk custom', 'success');
        return redirect()->back();
    }




    // END OF PRODUK CUSTOM

    public function daftarFinishing()
    {

        $user = $this->getLogUser();

        $finishing = DB::table('finishings')->where('id_toko', $user->id_toko)->get();


        return view('seller.produkCustom.finishing.masterFinishing', ['user' => $user, 'listFinishing' => $finishing]);
    }

    public function addFinishing(Request $request)
    {

        $user = $this->getLogUser();

        $f = new Finishing();
        $f->id_toko = $user->id_toko;
        $f->nama_finishing = $request->namaFinishing;
        $f->tingkat_kilau = $request->tingkatKilau;
        $f->deskripsi = $request->deskripsi;
        $f->save();

        toast("Berhasil Tambah Finishing", 'success');
        return redirect()->back();
    }

    public function editFinishing(Request $request)
    {

        $f = Finishing::find($request->id);
        $f->nama_finishing = $request->editNamaFinishing;
        $f->tingkat_kilau = $request->editTingkatKilau;
        $f->deskripsi = $request->editDeskripsi;
        $f->save();

        toast('Berhasil Edit Finishing', 'success');
        return redirect()->back();
    }

    public function deleteFinishing($id)
    {
        $f = Finishing::find($id);
        $f->delete();

        toast('Berhasil Hapus Finishing', 'success');
        return redirect()->back();
    }

    public function daftarFinishingDijual($id)
    {

        $user = $this->getLogUser();
        $produk = ProdukCustomDijual::find($id);
        $listMasterFinishing = DB::table('finishings')->where('id_toko', $user->id_toko)->get();
        $listFinishing = DB::table('finishing_dijuals')
            ->join('finishings', 'finishing_dijuals.id_finishing', '=', 'finishings.id')
            ->where('finishing_dijuals.id_produk', $id)
            ->select('finishings.*', 'finishing_dijuals.harga', 'finishing_dijuals.id as fdId')
            ->get();

            // dd($listFinishing);
        return view('seller.produkCustom.finishing.finishingDijual', ['user' => $user, 'produk' => $produk, 'masterFinishing' => $listMasterFinishing, 'listFinishing' => $listFinishing]);
    }

    public function addFinishingDijual(Request $request){

        $f = new FinishingDijual();
        $f->id_produk = $request->id;
        $f->id_finishing = $request->finishingId;
        $f->harga = $request->harga;
        $f->save();

        toast('Berhasil tambah', 'success');
        return redirect()->back();
    }

    public function editFinishingDijual(Request $request){
        // dd($request);
        $f = FinishingDijual::find($request->id);
        $f->harga = $request->editHarga;
        $f->save();
        // dd($f);

        toast('Berhasil Ubah Harga', 'success');
        return redirect()->back();
    }

    public function deleteFinishingDijual($id)
    {
        $f = FinishingDijual::find($id);
        $f->delete();

        toast('Berhasil Hapus Finishing', 'success');
        return redirect()->back();
    }
}
