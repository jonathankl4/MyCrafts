<?php

namespace App\Http\Controllers;

use App\Models\DetailAddonDijual;
use App\Models\DetailProdukCustomDijual;
use App\Models\ProdukCustomDijual;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class Lemari1Controller extends Controller
{
    //

    public function getLogUser(){
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


    public function tambahLemari1(){
        $user = $this->getLogUser();
        $toko =$this->getToko();


        $produk = DB::table('produk_custom_dijuals')->where('nama_template','=','Lemari 1')->where('id_toko','=',$user->id_toko)->first();

        if ($produk != null) {
            # code...
            // alert('produk sudah pernah ditambahkan');
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
        }
        else{
            $p = new ProdukCustomDijual();
            $p->id_toko = $user->id_toko;
            $p->nama_template = 'Lemari 1';
            $p->kode = 'lemari1';
            $p->status = 'nonaktif';
            $p->nama_produk = 'lemari 1';
            $p->panjang_max = 60;
            $p->panjang_min = 45;
            $p->tinggi_max = 200;
            $p->tinggi_min = 170;
            $p->lebar_max = 120;
            $p->lebar_min = 80;
            $p->save();

            Alert::success("Sukses", "Berhasil menambahkan produk");
            return redirect()->back();
        }

    }

    public function testing(){
        $user = $this->getLogUser();
        $produk = DB::table('produk_custom_dijuals')->where('nama_template','=','Lemari 1')->where('id_toko','=',$user->id_toko)->first();

        $idProdukCustomDijual = $produk->id;
        $detail = DB::table('detail_produk_custom_dijuals')->where('id_produk_custom_dijual','=',$produk->id)->get();
        $addonMain = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=',$produk->id)->where('jenis','=','main')->get();


        $addonPrices = [];

        foreach($addonMain as $item){

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
        return view('seller.produkCustom.produk.testing.lemari1.h1lemari1', ['user'=>$user, 'detail'=>$detail, 'addonPrices'=>$addonPrices, 'listAddOnMain'=>$addonMain, 'produk'=>$produk]);
    }


    public function testing2(){
        $user = $this->getLogUser();
        $produk = DB::table('produk_custom_dijuals')->where('nama_template','=','Lemari 1')->where('id_toko','=',$user->id_toko)->first();
        $addonSecond = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=',$produk->id)->where('jenis','=','second')->get();


        $addonPrices = [];

        foreach($addonSecond as $item){

            $addonPrices[$item->kode] = $item->harga;

        }

        // dd($addonPrices);


        return view('seller.produkCustom.produk.testing.lemari1.h2lemari1', ['user'=>$user, 'listPintu'=>$addonSecond, 'addonPrices'=>$addonPrices]);

    }

    public function page2Custom($id){

        // dd("kebukak coi");
        $user = $this->getLogUser();
        $produk = ProdukCustomDijual::find($id);
        $addonSecond = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=',$produk->id)->where('jenis','=','second')->get();
        $listFinishing = DB::table('finishing_dijuals')
            ->join('finishings', 'finishing_dijuals.id_finishing', '=', 'finishings.id')
            ->where('finishing_dijuals.id_produk', $id)
            ->select('finishings.*', 'finishing_dijuals.harga', 'finishing_dijuals.id as fdId')
            ->get();

        $addonPrices = [];

        foreach($addonSecond as $item){

            $addonPrices[$item->kode] = $item->harga;

        }

        // dd($addonPrices);


        return view('customer.shopping.produkCustom.lemari1.h2lemari1', ['user'=>$user, 'listPintu'=>$addonSecond, 'addonPrices'=>$addonPrices, 'listFinishing'=>$listFinishing]);
    }



    public function ubahDetailLemari1(Request $request){

        $user = $this->getLogUser();
        $produk = DB::table('produk_custom_dijuals')->where('nama_template','=','Lemari 1')->where('id_toko','=',$user->id_toko)->first();

        $idProdukCustomDijual = $produk->id;
        $detail = DB::table('detail_produk_custom_dijuals')->where('id_produk_custom_dijual','=',$produk->id)->get();
        $addon = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=',$produk->id)->get();

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
            }
            else {
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
            }
            else {
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

        if ($request->has('sekatVertical')) {
            if (!empty($request->sekatVertical)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Sekat Vertical',
                    ],
                    [
                        'harga' => $request->sekatVertical,
                        'jenis' => 'main',
                        'tipe' => 'lemari',
                        'kode'=> 'sekatVertical',
                        'url' => 'img/sekatvertical.jpeg'

                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Sekat Vertical')
                    ->delete();
            }
        }

        if ($request->has('sekatHorizontal')) {
            if (!empty($request->sekatHorizontal)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Sekat Horizontal',
                    ],
                    [
                        'harga' => $request->sekatHorizontal,
                        'jenis' => 'main',
                        'tipe' => 'lemari',
                        'kode'=> 'sekatHorizontal',
                        'url' => 'img/sekatHorizontal.jpeg'

                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Sekat Horizontal')
                    ->delete();
            }
        }

        if ($request->has('gantungan')) {
            if (!empty($request->gantungan)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Gantungan',
                    ],
                    [
                        'harga' => $request->gantungan,
                        'jenis' => 'main',
                        'tipe' => 'lemari',
                        'kode'=> 'gantungan',
                        'url' => 'img/gantungan.jpeg'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Gantungan')
                    ->delete();
            }
        }
        if ($request->has('lacikecil')) {
            if (!empty($request->lacikecil)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'lacikecil',
                    ],
                    [
                        'harga' => $request->lacikecil,
                        'jenis' => 'main',
                        'tipe' => 'lemari',
                        'kode'=> 'laciKecil',
                        'url' => 'img/lemari2/lacikecil.png'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'lacikecil')
                    ->delete();
            }
        }
        if ($request->has('lacibesar')) {
            if (!empty($request->lacibesar)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'lacibesar',
                    ],
                    [
                        'harga' => $request->lacibesar,
                        'jenis' => 'main',
                        'tipe' => 'lemari',
                        'kode'=> 'laciBesar',
                        'url' => 'img/lemari2/lacibesar.png'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'lacibesar')
                    ->delete();
            }
        }


        // Proses input untuk Pintu

        if ($request->has('pintu1')) {
            if (!empty($request->pintu1)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Pintu 1',
                    ],
                    [
                        'harga' => $request->pintu1,
                        'jenis' => 'second',
                        'tipe' => 'lemari',
                        'kode'=> 'pintu1',
                        'url' => 'img/lemari1/pintu1.jpeg'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Pintu 1')
                    ->delete();
            }
        }

        if ($request->has('pintu2')) {
            if (!empty($request->pintu2)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Pintu 2',
                    ],
                    [
                        'harga' => $request->pintu2,
                        'jenis' => 'second',
                        'tipe' => 'lemari',
                        'kode'=> 'pintu2',
                        'url' => 'img/lemari1/pintu2.jpg'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Pintu 2')
                    ->delete();
            }
        }


        if ($request->has('pintu3')) {
            if (!empty($request->pintu3)) {
                DetailAddonDijual::updateOrCreate(
                    [
                        'id_produk_custom_dijual' => $idProdukCustomDijual,
                        'nama_addon' => 'Pintu 3',
                    ],
                    [
                        'harga' => $request->pintu3,
                        'jenis' => 'second',
                        'tipe' => 'lemari',
                        'kode'=> 'pintu3',
                        'url' => 'img/lemari1/pintugeser.jpg'
                    ]
                );
            } else {
                DetailAddonDijual::where('id_produk_custom_dijual', $idProdukCustomDijual)
                    ->where('nama_addon', 'Pintu 3')
                    ->delete();
            }
        }

        Alert::success('success', 'berhasil save detail');

        return redirect()->back();

    }
}
