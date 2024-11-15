<?php

namespace App\Http\Controllers;

use App\Models\DetailAddonDijual;
use App\Models\DetailProdukCustomDijual;
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

    public function page2Custom($id){

        // dd("kebukak coi");
        $user = $this->getLogUser();
        $produk = ProdukCustomDijual::find($id);
        $addonSecond = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=',$produk->id)->where('jenis','=','second')->get();


        $addonPrices = [];

        foreach($addonSecond as $item){

            $addonPrices[$item->kode] = $item->harga;

        }

        // dd($addonPrices);


        return view('customer.shopping.produkCustom.meja2.Ch2meja2', ['user'=>$user, 'listPintu'=>$addonSecond, 'addonPrices'=>$addonPrices,]);
    }

    public function tambahMeja2()
    {
        $user = $this->getLogUser();

        $produk = DB::table('produk_custom_dijuals')->where('nama_template', '=', 'Meja 2')->where('id_toko', '=', $user->id_toko)->first();

        if ($produk != null) {
            if ($produk->deleted == 1) {
                # code...

                $pr = ProdukCustomDijual::find($produk->id);
                $pr->deleted = 0;
                $pr->save();
                Alert::success("Sukses", "Berhasil menambahkan produk");
            return redirect()->back();
            }
            else{

                toast('Produk Sudah Pernah ditambahkan', 'info');
                return redirect()->back();
            }
        } else {
            $p = new ProdukCustomDijual();
            $p->id_toko = $user->id_toko;
            $p->nama_template = 'Meja 2';
            $p->kode = 'meja2';
            $p->status = 'nonaktif';
            $p->panjang_max = 130;
            $p->panjang_min = 100;
            $p->tinggi_max = 80;
            $p->tinggi_min = 70;
            $p->lebar_max = 80;
            $p->lebar_min = 50;
            $p->save();

            Alert::success("Sukses", "Berhasil menambahkan produk");
            return redirect()->back();
        }
    }

    public function ubahDetailMeja2(Request $request)
    {

        $user = $this->getLogUser();
        $produk = DB::table('produk_custom_dijuals')->where('nama_template', '=', 'Meja 2')->where('id_toko', '=', $user->id_toko)->first();

        $idProdukCustomDijual = $produk->id;
        $detail = DB::table('detail_produk_custom_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->get();
        $addon = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->get();

        $ctrdetail = false;
        $ctraddon = false;

        // dd($request);

        if ($request->has('hargaJati')) {
            if (!empty($request->hargaJati)) {
                // Update atau buat data baru jika checkbox dicentang
                DetailProdukCustomDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'jenis_kayu' => 'Kayu Jati',
                    ],
                    [
                        'harga' => $request->hargaJati,
                    ]
                );
            } else {
                // Hapus data jika checkbox tidak dicentang
                DetailProdukCustomDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('jenis_kayu', 'Kayu Jati')
                    ->delete();
            }
        }

        if ($request->has('hargaMahoni')) {
            if (!empty($request->hargaMahoni)) {
                DetailProdukCustomDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'jenis_kayu' => 'Kayu Mahoni',
                    ],
                    [
                        'harga' => $request->hargaMahoni,
                    ]
                );
            } else {
                DetailProdukCustomDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('jenis_kayu', 'Kayu Mahoni')
                    ->delete();
            }
        }


        if ($request->has('hargaPinus')) {
            if (!empty($request->hargaPinus)) {
                DetailProdukCustomDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'jenis_kayu' => 'Kayu Pinus',
                    ],
                    [
                        'harga' => $request->hargaPinus,
                    ]
                );
            } else {
                DetailProdukCustomDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('jenis_kayu', 'Kayu Pinus')
                    ->delete();
            }
        }

        if ($request->has('hargaSungkai')) {
            if (!empty($request->hargaSungkai)) {
                DetailProdukCustomDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'jenis_kayu' => 'Kayu Sungkai',
                    ],
                    [
                        'harga' => $request->hargaSungkai,
                    ]
                );
            } else {
                DetailProdukCustomDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('jenis_kayu', 'Kayu Sungkai')
                    ->delete();
            }
        }

        // Proses input untuk Add-ons


        if ($request->has('laci1')) {
            if (!empty($request->laci1)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Laci 1',
                    ],
                    [
                        'harga' => $request->laci1,
                        'jenis' => 'main',
                        'tipe' => 'lemari',
                        'kode'=> 'laci1',
                        'url' => 'img/lemari2/lacikecil.png'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Laci 1')
                    ->delete();
            }
        }
        if ($request->has('laci2')) {
            if (!empty($request->laci2)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Laci 2',
                    ],
                    [
                        'harga' => $request->laci2,
                        'jenis' => 'main',
                        'tipe' => 'meja',
                        'kode'=> 'laci2',
                        'url' => 'img/meja1/laciKecil2.png'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Laci 2')
                    ->delete();
            }
        }
        if ($request->has('pijakankaki')) {
            if (!empty($request->pijakankaki)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Pijakan Kaki',
                    ],
                    [
                        'harga' => $request->pijakankaki,
                        'jenis' => 'main',
                        'tipe' => 'meja',
                        'kode'=> 'pijakankaki',
                        'url' => 'img/meja1/pijakanKaki.png'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Pijakan Kaki')
                    ->delete();
            }
        }
        if ($request->has('penutupbelakang')) {
            if (!empty($request->penutupbelakang)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Penutup Belakang',
                    ],
                    [
                        'harga' => $request->penutupbelakang,
                        'jenis' => 'second',
                        'tipe' => 'meja',
                        'kode'=> 'penutupbelakang',
                        'url' => 'img/meja1/penutup.png'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Penutup Belakang')
                    ->delete();
            }
        }
        Alert::success('success', 'berhasil save detail');

        return redirect()->back();
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
