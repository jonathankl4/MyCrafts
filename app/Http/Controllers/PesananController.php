<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DTrans;
use App\Models\HTrans;
use App\Models\ProdukCustomDijual;
use App\Models\ProdukDijual;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
{
    //
    public function getLogUser()
    {
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    // page semua pesanan
    public function pagePesanan()
    {

        $user = $this->getLogUser();


        $pembelian = DB::table('h_trans')->where('id_toko', $user->id_toko)->whereIn('status', [1, 2, 3, 11])->orderBy('tgl_transaksi', 'desc')->get();

        // dd($pembelian);
        return view('seller.pesanan.pesanan', ['user' => $user, 'pembelian' => $pembelian]);
    }

    // page pesanan yang non custom
    public function pagePesananNonCustom(){
        $user = $this->getLogUser();


        $pembelian = DB::table('h_trans')->where('id_toko', $user->id_toko)->where('tipe_trans', 'Non-Custom')->whereIn('status', [1, 2, 3, 11])->orderBy('tgl_transaksi', 'desc')->get();

        // dd($pembelian);
        return view('seller.pesanan.listPesanan.PNonCustom', ['user' => $user, 'pembelian' => $pembelian]);
    }
    // page pesanan custom
    public function pagePesananCustom(){
        $user = $this->getLogUser();


        $pembelian = DB::table('h_trans')->where('id_toko', $user->id_toko)->where('tipe_trans', 'custom')->whereIn('status', [1, 2, 3])->orderBy('tgl_transaksi', 'desc')->get();

        // dd($pembelian);
        return view('seller.pesanan.listPesanan.PCustom', ['user' => $user, 'pembelian' => $pembelian]);
    }
    // page pesanan yang sedang dalam proses produksi
    public function pagePesananProduksi(){
        $user = $this->getLogUser();


        $pembelian = DB::table('h_trans')->where('id_toko', $user->id_toko)->where('tipe_trans', 'custom')->whereIn('status', [4])->orderBy('tgl_transaksi', 'desc')->get();

        // dd($pembelian);
        return view('seller.pesanan.listPesanan.PProduksi', ['user' => $user, 'pembelian' => $pembelian]);
    }

    // page pesanan yang siap dikirim
    public function pagePesananSiapDikirim(){
        $user = $this->getLogUser();


        $pembelian = DB::table('h_trans')->where('id_toko', $user->id_toko)->whereIn('status', [5])->orderBy('tgl_transaksi', 'desc')->get();

        // dd($pembelian);
        return view('seller.pesanan.listPesanan.PSiapDikirim', ['user' => $user, 'pembelian' => $pembelian]);
    }

    // page pesanan yang dalam Pengiriman
    public function pagePesananDalamPengiriman(){
        $user = $this->getLogUser();


        $pembelian = DB::table('h_trans')->where('id_toko', $user->id_toko)->whereIn('status', [6])->orderBy('tgl_transaksi', 'desc')->get();

        // dd($pembelian);
        return view('seller.pesanan.listPesanan.PDalamPengiriman', ['user' => $user, 'pembelian' => $pembelian]);
    }
    // page pesanan yang sudah selesai
    public function pagePesananSelesai(){
        $user = $this->getLogUser();


        $pembelian = DB::table('h_trans')->where('id_toko', $user->id_toko)->whereIn('status', [7])->orderBy('tgl_transaksi', 'desc')->get();

        // dd($pembelian);
        return view('seller.pesanan.listPesanan.PSelesai', ['user' => $user, 'pembelian' => $pembelian]);
    }
    // page pesanan yang dibatalkan
    public function pagePesananBatal(){
        $user = $this->getLogUser();


        $pembelian = DB::table('h_trans')->where('id_toko', $user->id_toko)->whereIn('status', [8,9])->orderBy('tgl_transaksi', 'desc')->get();

        // dd($pembelian);
        return view('seller.pesanan.listPesanan.PBatal', ['user' => $user, 'pembelian' => $pembelian]);
    }

    public function detailPesanan($id)
    {

        $user = $this->getLogUser();

        $pembelian = HTrans::find($id);




        // dd($pembelian);
        if ($pembelian->tipe_trans == 'Non-Custom') {

            $produk = ProdukDijual::find($pembelian->id_produk);
            # code...
            return view('seller.pesanan.detailPesananNonCustom', ['user' => $user, 'detail' => $pembelian, 'produk'=>$produk]);
        }elseif ($pembelian->tipe_trans == 'custom') {
            # code...
            $addon = DB::table('d_trans')->where('h_trans_id', $id)->get();
            // dd($addon);

            return view('seller.pesanan.detailPesanan', ['user' => $user, 'detail' => $pembelian, 'addon' => $addon]);
        }




    }
    public function terimaPesananNonCustom(Request $request){
        $user = $this->getLogUser();

        $pembelian = HTrans::find($request->id_htrans);
        $pembelian->status = 3;
        $pembelian->ongkir = $request->ongkir;
        $pembelian->save();

        $harga = $pembelian->harga + $request->ongkir;
        $order_id = 'DONATION-' . mt_rand(100000, 999999);

        $transaction = Donation::create([
            'code'   => $order_id,
            'name'   => $user->username,
            'email'  => $user->email,
            'amount' => $harga,
            'note'   => "-",
            'pilihan' => 'jadi',
            'h_trans_id' => $request->id_htrans,
        ]);
        \Midtrans\Config::$serverKey    = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('midtrans.is3ds');


        $params = array(
            'transaction_details' => array(
                'order_id' => $order_id,
                'gross_amount' => $harga,
            ),
            'customer_details' => array(
                'first_name' => $user->username,
                'email'      => $user->email,

            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;
        $transaction->save();

        return response()->json(['success' => true]);
    }
    public function terimaPesananCustom(Request $request) {

        $user = $this->getLogUser();

        $pembelian = HTrans::find($request->id_htrans);
        $pembelian->harga = $request->fixHarga;
        $pembelian->status = 3;
        $pembelian->ongkir = $request->ongkir;
        $pembelian->pilihan = 'awal';
        $pembelian->save();

        $harga = $request->fixHarga+$request->ongkir;


        $transaction = Donation::create([
            'code'   => 'DONATION-' . mt_rand(100000, 999999),
            'name'   => $user->username,
            'email'  => $user->email,
            'amount' => $harga,
            'note'   => "-",
            'pilihan' => 'awal',
            'h_trans_id' => $request->id_htrans,
        ]);
        \Midtrans\Config::$serverKey    = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('midtrans.is3ds');


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $harga,
            ),
            'customer_details' => array(
                'first_name' => $user->username,
                'email'      => $user->email,

            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;
        $transaction->save();


        return response()->json(['success' => true]);

    }



    public function redesain($id)
    {

        $user = $this->getLogUser();

        $pembelian = HTrans::find($id);
        $detailPembelian = DB::table('d_trans')->where('h_trans_id', $id)->get();
        $produkCustom = ProdukCustomDijual::find($pembelian->id_produk);
        $detail = DB::table('detail_produk_custom_dijuals')->where('id_produk_custom_dijual', '=', $produkCustom->id)->get();
        $addonMain = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=', $produkCustom->id)->where('jenis', '=', 'main')->get();
        // dd($produkCustom);

        $addonPrices = [];

        foreach ($addonMain as $item) {

            $addonPrices[$item->kode] = $item->harga;
        }

        if ($produkCustom->kode == 'lemari1') {
            return view('seller.pesanan.redesain.redesainh1lemari1', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produkCustom, 'pembelian' => $pembelian, 'detailPembelian' => $detailPembelian]);
        } else if ($produkCustom->kode == 'lemari2') {
            return view('seller.pesanan.redesain.redesainh1lemari2', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produkCustom, 'pembelian' => $pembelian, 'detailPembelian' => $detailPembelian]);
        } else if($produkCustom->kode == 'lemari3'){
            return view('seller.pesanan.redesain.redesainh1lemari3', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produkCustom, 'pembelian' => $pembelian, 'detailPembelian' => $detailPembelian]);
        }
    }


    public function kirimRedesain(Request $request)
    {

        $user = $this->getLogUser();
        $imageData = $request->image;
        $sekatHorizontal = $request->input('sekatHorizontal');
        $sekatVertical = $request->input('sekatVertical');
        $gantungan = $request->input('gantungan');
        $addonPrices = $request->input('addonPrices');


        //buat nama file unik
        $fileName = uniqid() . '.png';

        //hapus prefix 'data:image/png;base64,'
        $imageData = str_replace('data:image/png;base64', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);

        $image = base64_decode($imageData);

        $filePath = 'public/hasilcustom/' . $fileName;
        Storage::put($filePath, $image);

        $trans = HTrans::find($request->id_Htrans);
        $trans->fotoredesain = $fileName;
        $trans->status_redesain = 1;
        $trans->harga = $request->hargaFix;
        $trans->harga_redesain = $request->hargaRedesain;
        $trans->status = 2;
        $trans->ongkir = $request->ongkir;
        $trans->save();

        $transaction = Donation::create([
            'code'   => 'DONATION-' . mt_rand(100000, 999999),
            'name'   => $user->username,
            'email'  => $user->email,
            'amount' => $request->hargaFix+$request->ongkir,
            'note'   => "-",
            'pilihan' => 'awal',
            'h_trans_id' => $request->id_Htrans,
        ]);
        \Midtrans\Config::$serverKey    = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('midtrans.is3ds');


        $params = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->hargaFix+$request->ongkir,
            ),
            'customer_details' => array(
                'first_name' => $user->username,
                'email'      => $user->email,

            ),

        );

        $snapToken = \Midtrans\Snap::getSnapToken($params);

        $transaction->snap_token = $snapToken;
        $transaction->save();

        $transaction2 = Donation::create([
            'code'   => 'DONATION-' . mt_rand(100000, 999999),
            'name'   => $user->username,
            'email'  => $user->email,
            'amount' => $request->hargaRedesain+$request->ongkir,
            'note'   => "-",
            'pilihan' => 'baru',
            'h_trans_id' => $request->id_Htrans,
        ]);
        \Midtrans\Config::$serverKey    = config('midtrans.serverKey');
        \Midtrans\Config::$isProduction = config('midtrans.isProduction');
        \Midtrans\Config::$isSanitized  = config('midtrans.isSanitized');
        \Midtrans\Config::$is3ds        = config('midtrans.is3ds');


        $params2 = array(
            'transaction_details' => array(
                'order_id' => rand(),
                'gross_amount' => $request->hargaRedesain+$request->ongkir,
            ),
            'customer_details' => array(
                'first_name' => $user->username,
                'email'      => $user->email,

            ),

        );

        $snapToken2 = \Midtrans\Snap::getSnapToken($params2);

        $transaction2->snap_token = $snapToken2;
        $transaction2->save();

        if ($trans) {
            // If found, update the existing transaction



            // Simpan data add-on Sekat Horizontal jika ada
            if ($sekatHorizontal) {
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => 'Sekat Horizontal',
                    'jumlah' => $sekatHorizontal,
                    'harga' => $addonPrices['sekatHorizontal'], // Gunakan harga dari halaman 1
                    'jenis' => 'main',
                    'cek_redesain' => 'yes',

                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Simpan data add-on Sekat Vertical jika ada
            if ($sekatVertical) {
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => 'Sekat Vertical',
                    'jumlah' => $sekatVertical,
                    'harga' => $addonPrices['sekatVertical'], // Gunakan harga dari halaman 1
                    'jenis' => 'main',
                    'cek_redesain' => 'yes',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Simpan data add-on Gantungan jika ada
            if ($gantungan) {
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => 'Gantungan',
                    'jumlah' => $gantungan,
                    'harga' => $addonPrices['gantungan'], // Gunakan harga dari halaman 1
                    'jenis' => 'main',
                    'cek_redesain' => 'yes',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }


        return response()->json(['success' => true, 'file_path' => $filePath]);
    }
}
