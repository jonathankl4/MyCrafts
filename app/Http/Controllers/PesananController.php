<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\DTrans;
use App\Models\HTrans;
use App\Models\ProdukCustomDijual;
use App\Models\ProdukDijual;
use App\Models\toko;
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
    public function pagePesanan(Request $request)
    {

        $user = $this->getLogUser();
        $status = $request->query('status', 'semua');
        $subStatus = $request->query('sub_status', null);


        switch ($status) {
            case 'berjalan':
                # code...
                $query = DB::table('h_trans')->where('id_toko', $user->id_toko);

                if ($subStatus == 'menunggu_konfirmasi') {
                    # code...
                    $query->whereIn('status', [1]);
                } elseif ($subStatus == 'menunggu_pembayaran'){
                    $query->whereIn('status', [2, 3]);

                } elseif ($subStatus == 'sedang_produksi'){
                    $query->whereIn('status', [4, 5]);
                } elseif($subStatus == 'siap_dikirim'){
                    $query->where('status', 11);
                }
                elseif ($subStatus == 'dikirim'){
                    $query->where('status', 6);
                }
                else {
                    $query->whereIn('status', [1, 2, 3, 4, 5, 6, 11]);
                }

                $pembelian = $query->orderBy('tgl_transaksi', 'desc')->get();
                break;

            case 'berhasil':
                $pembelian = DB::table('h_trans')
                    ->where('id_toko', $user->id_toko)
                    ->where('status', 7)
                    ->orderBy('tgl_transaksi', 'desc')
                    ->get();
                break;
            case 'tidak_berhasil':
                $pembelian = DB::table('h_trans')
                    ->where('id_toko', $user->id_toko)
                    ->whereIn('status', [8, 9 , 10])
                    ->orderBy('tgl_transaksi', 'desc')
                    ->get();
                break;
            default:
                # code...
                $pembelian = DB::table('h_trans')->where('id_toko', $user->id_toko)->where('status', '!=', 0)->orderBy('tgl_transaksi', 'desc')->get();
                break;
        }




        // dd($pembelian);
        return view('seller.pesanan.pesanan', ['user' => $user, 'pembelian' => $pembelian, 'status'=>$status, 'sub_status'=>$subStatus]);
    }

    // page pesanan yang non custom
    public function selesaiProduksi($id){

        $user = $this->getLogUser();

        $htrans = HTrans::find($id);

        $htrans->status = 11;
        $htrans->save();

        toast('Produksi Selesai', 'success');
        return redirect()->back();
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

            $produk = ProdukCustomDijual::find($pembelian->id_produk);
            // dd($addon);

            return view('seller.pesanan.detailPesanan', ['user' => $user, 'detail' => $pembelian, 'addon' => $addon, 'produk'=>$produk]);
        }




    }

    public function tolakPesanan(Request $request){

        $pembelian = HTrans::find($request->id);

        $pembelian->status = 8;
        $pembelian->alasan_batal = $request->alasan;
        $pembelian->save();

        toast('Pesanan Berhasil Dibatalkan', 'success');
        return redirect()->back();
    }

    public function kirimPesanan(Request $request){
        $pembelian = Htrans::find($request->id);

        $pembelian->nomor_resi = $request->resi;
        $pembelian->status = 6;
        $pembelian->save();

        toast('Status Diubah ke Sedang Dikirim', 'success');
        return redirect()->back();
    }

    public function ubahResi(Request $request){
        $pembelian = Htrans::find($request->id);

        $pembelian->nomor_resi = $request->editresi;

        $pembelian->save();

        toast('Berhasil Ubah Nomor Resi', 'success');
        return redirect()->back();
    }

    public function terimaRetur(Request $request){
        $pembelian = Htrans::find($request->id);


        $pembelian->status = 14;
        $pembelian->save();

        toast('Retur Diterima, tunggu customer mengirim kembali', 'success');
        return redirect()->back();
    }

    public function tolakRetur(Request $request){
        $pembelian = Htrans::find($request->id);


        $pembelian->status = 16;
        $pembelian->alasan_tolak_retur = $request->alasanTolak;
        $pembelian->save();

        $toko = toko::find($pembelian->id_toko);
        if ($pembelian->pilihan == 'jadi' || $pembelian->pilihan == 'awal') {
            # code...
            $total = $pembelian->harga + $pembelian->ongkir;
            $toko->saldo += $total;
            $toko->saldo_pending -= $total;
            $toko->save();

        }else if ($pembelian->pilihan == 'baru') {
            # code...
            $total = $pembelian->harga_redesain + $pembelian->ongkir;
            $toko->saldo += $total;
            $toko->saldo_pending -= $total;
            $toko->save();
        }


        toast('Retur Ditolak, Pesanan Selesai', 'success');
        return redirect()->back();
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

        $order_id = 'DONATION-' . mt_rand(100000, 999999);

        $transaction = Donation::create([
            'code'   => $order_id,
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
        } else if($produkCustom->kode == 'meja1'){
            return view('seller.pesanan.redesain.redesainh1meja1', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produkCustom, 'pembelian' => $pembelian, 'detailPembelian' => $detailPembelian]);
        } else if($produkCustom->kode == 'meja2'){
            return view('seller.pesanan.redesain.redesainh1meja2', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produkCustom, 'pembelian' => $pembelian, 'detailPembelian' => $detailPembelian]);
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
        $laci1 = $request->input('laci1');
        $laci2 = $request->input('laci2');
        $pijakankaki = $request->input('pijakankaki');


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

        $order_id1 = 'DONATION-' . mt_rand(100000, 999999);
        $order_id2 = 'DONATION-' . mt_rand(100000, 999999);

        $transaction = Donation::create([
            'code'   => $order_id1,
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
                'order_id' => $order_id1,
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
            'code'   => $order_id2,
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
                'order_id' => $order_id2,
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

            if ($laci1) {
                # code...
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => 'Laci 1',
                    'jumlah' => $laci1,
                    'harga' => $addonPrices['laci1'], // Gunakan harga dari halaman 1
                    'jenis' => 'main',
                    'cek_redesain' => 'yes',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);

            }
            if ($laci2) {
                # code...
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => 'Laci 2',
                    'jumlah' => $laci2,
                    'harga' => $addonPrices['laci2'], // Gunakan harga dari halaman 1
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
