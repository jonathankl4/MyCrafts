<?php

namespace App\Http\Controllers;

use App\Models\ProdukCustomDijual;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class Meja2Controller extends Controller
{
    //

    public function getLogUser()
    {
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function tambahMeja2()
    {
        $user = $this->getLogUser();

        $produk = DB::table('produk_custom_dijuals')->where('nama_template', '=', 'Meja 2')->where('id_toko', '=', $user->id_toko)->first();

        if ($produk != null) {
            # code...
            toast('Produk Sudah Pernah ditambahkan', 'info');
            return redirect()->back();
        } else {
            $p = new ProdukCustomDijual();
            $p->id_toko = $user->id_toko;
            $p->nama_template = 'Meja 2';
            $p->kode = 'meja2';
            $p->status = 'nonaktif';
            $p->save();

            Alert::success("Sukses", "Berhasil menambahkan produk");
            return redirect()->back();
        }
    }

    public function testing()
    {
        $user = $this->getLogUser();
        $produk = DB::table('produk_custom_dijuals')->where('nama_template', '=', 'Meja 2')->where('id_toko', '=', $user->id_toko)->first();

        $idProdukCustomDijual = $produk->id;
        $detail = DB::table('detail_produk_custom_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->get();
        $addonMain = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->where('jenis', '=', 'main')->get();



        $addonPrices = [];

        foreach ($addonMain as $item) {

            $addonPrices[$item->kode] = $item->harga;
        }
        // foreach($addonMain as $item){
        //     if ($item->nama_addon === 'Sekat Horizontal') {
        //         $addonPrices['sekatHorizontal'] = $item->harga;
        //     } elseif ($item->nama_addon === 'Sekat Vertical') {
        //         $addonPrices['sekatvertical'] = $item->harga;
        //     } elseif ($item->nama_addon === 'Gantungan') {
        //         $addonPrices['gantungan'] = $item->harga;
        //     }
        // }

        // dd($addonPrices);
        return view('seller.produkCustom.produk.testing.meja2.h1meja2', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk'=>$produk]);
    }

    public function testing2(){
        $user = $this->getLogUser();
        $produk = DB::table('produk_custom_dijuals')->where('nama_template','=','Meja 2')->where('id_toko','=',$user->id_toko)->first();
        $addonSecond = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=',$produk->id)->where('jenis','=','second')->get();


        $addonPrices = [];

        foreach($addonSecond as $item){

            $addonPrices[$item->kode] = $item->harga;

        }

        // dd($addonPrices);


        return view('seller.produkCustom.produk.testing.meja2.h2meja2', ['user'=>$user, 'listpenutup'=>$addonSecond, 'addonPrices'=>$addonPrices]);
    }

}
