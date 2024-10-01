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

class Lemari2Controller extends Controller
{
    //
    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function tambahLemari2(){
        $user = $this->getLogUser();

        $produk = DB::table('produk_custom_dijuals')->where('nama_template','=','Lemari 2')->where('id_toko','=',$user->id_toko)->first();

        if ($produk != null) {
            # code...
            toast('Produk Sudah Pernah ditambahkan', 'info');
            return redirect()->back();
        }
        else{
            $p = new ProdukCustomDijual();
            $p->id_toko = $user->id_toko;
            $p->nama_template = 'Lemari 2';
            $p->kode = 'lemari2';
            $p->save();

            Alert::success("Sukses", "Berhasil menambahkan produk");
            return redirect()->back();
        }
    }

    public function ubahDetailLemari2(Request $request){

        $user = $this->getLogUser();
        $produk = DB::table('produk_custom_dijuals')->where('nama_template','=','Lemari 2')->where('id_toko','=',$user->id_toko)->first();

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
