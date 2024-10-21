<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\HTrans;
use App\Models\Post;
use App\Models\ProdukCustomDijual;
use App\Models\ProdukDijual;
use App\Models\tester;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Midtrans\Notification;
use RealRashid\SweetAlert\Facades\Alert;
use stdClass;

class CustomerController extends Controller
{
    //


    public function getLogUser()
    {
        $user = new stdClass();
        $s = Session::get("user");

        if ($s != null) {
            # code...
            $us = User::find($s->id);
            if ($us == null) {
                Auth::guard('web')->logout();
                Session::forget('role');
                Session::forget('user');

                # code...
                $user->username = "Guest";
                $user->email = "Guest";
                $user->role = "guest";
            } else {
                $user = $us;
            }
        } else {
            $user->username = "Guest";
            $user->email = "Guest";
            $user->role = "guest";
        }
        // dd($s);

        return $user;
    }

    public function homePage()
    {



        // return view("admin.userlog",["user"])
        $user = $this->getLogUser();

        $listproduk = DB::table('produk_dijuals')->where('status', '=', 'aktif')->get();


        $random = $listproduk->shuffle()->take(4);

        $listCustom = DB::table('produk_custom_dijuals')->where('status', 'aktif')->get();

        return view("customer.shopping.dashboard", ['user' => $user, 'listProduk' => $listproduk, 'random' => $random, 'listCustom' => $listCustom]);
        // return view("customer.dashboard", ['user'=>$user]);

        // dd($user);
    }

    public function exploreProduk()
    {
        $user = $this->getLogUser();

        $listProduk = DB::table('produk_dijuals')->where('status', '=', 'aktif')->paginate(8);
        return view('customer.shopping.exploreProduk', ['user' => $user, 'listProduk' => $listProduk]);
    }




    public function daftarSeller()
    {
        $user = $this->getLogUser();

        if ($user->status == "owner") {
            # code...
            return redirect('/seller');
        }
        return view("seller.regseller", ['user' => $user]);
    }

    public function becomeSeller()
    {

        $user = $this->getLogUser();
        $user->status = "owner";
        $user->save();

        $toko = new toko();
        $toko->id_owner = $user->id;
        $toko->nama = $user->username;
        $toko->status = "free";
        $toko->save();


        $user->id_toko = $toko->id;
        $user->save();

        Alert::success('Berhasil menjadi Seller', '');

        return redirect(url('/seller'));
    }


    public function detailProduk($id)
    {


        $user = $this->getLogUser();
        $produk = ProdukDijual::find($id);


        $foto = [];


        if ($produk->foto_produk2 != null) {
            $foto[] = $produk->foto_produk2;
        }
        if ($produk->foto_produk3 != null) {
            $foto[] = $produk->foto_produk3;
        }
        if ($produk->foto_produk4 != null) {
            $foto[] = $produk->foto_produk4;
        }

        // dd($foto);



        // dd($produk);

        return view("customer.shopping.nonCustom.produkDetail", ['user' => $user, 'produk' => $produk, 'foto' => $foto]);
    }

    public function detailProdukCustom($id){
        $user = $this->getLogUser();
        $produk = ProdukCustomDijual::find($id);

        $detail = DB::table('detail_produk_custom_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->get();
        $addonMain = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->where('jenis', '=', 'main')->get();
        $addonSec = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->where('jenis', '=', 'second')->get();

        $foto = [];


        if ($produk->kode == "lemari1") {
            $foto[] = 'img/lemari1/lemari1.png';
        }
        if ($produk->kode == 'lemari2') {
            $foto[] = 'img/lemari2/lemari2.png';
        }
        if ($produk->kode == 'lemari3') {
            $foto[] = 'img/lemari3/lemari3.png';
            $foto[] = 'img/lemari3/lemari3samping.png';
        }
        return view("customer.shopping.produkCustom.produkCustomDetail", ['user' => $user, 'produk' => $produk, 'foto' => $foto, 'detail'=>$detail, 'addonMain'=>$addonMain, 'addonSec'=>$addonSec]);

    }

    public function halamanCheckout(Request $request)
    {

        $user = $this->getLogUser();

        $produk = ProdukDijual::find($request->idProduk);
        $jumlah = $request->jumlah;


        return view('customer.shopping.nonCustom.halamanCheckout', ['user' => $user, 'produk' => $produk, 'jumlah' => $jumlah]);
    }

    public function checkOutNonCustom(Request $request)
    {
        $user = $this->getLogUser();

        // dd($request);
        $produk = ProdukDijual::find($request->idProduk);


        $harga = $produk->harga_produk * $request->jumlah;
        // dd($harga);
        $trans = HTrans::create([
            'id_toko' => $produk->id_toko,
            'id_user' => $user->id,
            'id_produk' => $request->idProduk,
            'nama_produk' => $produk->nama_produk,
            'jumlah' => $request->jumlah,
            'tipe_trans' => 'Non-Custom',
            'harga' => $harga,
            'status' => 3,
            'tgl_transaksi' => now(),
            'catatan' => $request->catatan,
            'alamat' => $request->alamat,
            'nomorTelepon' => $request->nomorTelp

        ]);

        // dd($trans->id);

        $transaction = Donation::create([
            'code'   => 'DONATION-' . mt_rand(100000, 999999),
            'name'   => $user->username,
            'email'  => $user->email,
            'amount' => $harga,
            'note'   => "-",
            'pilihan' => 'jadi',
            'h_trans_id' => $trans->id,
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

        toast('transaksi berhasil, silahkan lakukan pembayaran', 'success');
        return redirect(url('/'));
    }

    public function pembayaran(Request $request)
    {


        $donation = Donation::where('h_trans_id', $request->idHtrans)->first();
        if ($request->pilihan == 'awal') {
            # code...
            $donation = Donation::where('h_trans_id', $request->idHtrans)->where('pilihan', 'awal')->first();
        }
        else if($request->pilihan == 'baru'){
            $donation = Donation::where('h_trans_id', $request->idHtrans)->where('pilihan', 'baru')->first();

        }
       $htrans = Htrans::find($request->idHtrans);
        // Find the donation by its order ID

        // Find the related h_trans record

        $donation->status = 'success';
        $htrans->status = 4; // Update

        // Save the updated donation and h_trans records
        $donation->save();
        $htrans->save();

        return response()->json(['success' => true], 200);
    }

    public function listPembelian()
    {
        $user = $this->getLogUser();

        $pembelian = DB::table('h_trans')->where('id_user', $user->id)->whereIn('status', [1, 2, 3, 4])->orderBy('tgl_transaksi', 'desc')->get();

        return view('customer.shopping.pembelian', ['user' => $user, 'pembelian' => $pembelian]);
    }

    public function detailTransaksiCustom($id)
    {

        $user = $this->getLogUser();

        $htrans = HTrans::find($id);
        $dtrans = DB::table('d_trans')->where('h_trans_id', $id)->get();

        $data1 = DB::table('donations')->where('h_trans_id', $id)->where('pilihan', 'awal')->first();
        $data2 = DB::table('donations')->where('h_trans_id', $id)->where('pilihan', 'baru')->first();

        return view('customer.shopping.detailPembelianCustom', ['user' => $user, 'htrans' => $htrans, 'dtrans' => $dtrans, 'data1' => $data1, 'data2' => $data2]);
    }

    public function detailTransaksiNonCustom($id)
    {
        $user = $this->getLogUser();

        $htrans = HTrans::find($id);
        $dtrans = DB::table('d_trans')->where('h_trans_id', $id)->get();

        $data1 = DB::table('donations')->where('h_trans_id', $id)->first();


        return view('customer.shopping.nonCustom.detailPembelianNonCustom', ['user' => $user, 'htrans' => $htrans, 'dtrans' => $dtrans, 'data1' => $data1]);
    }

    public function pageCustom($id)
    {

        // tipe dipakek untuk mngetaui apakah halaman dighunakan untuk beli atau pengajuan redesign

        $user = $this->getLogUser();

        $produk = ProdukCustomDijual::find($id);
        $detail = DB::table('detail_produk_custom_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->get();
        $addonMain = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->where('jenis', '=', 'main')->get();


        $addonPrices = [];

        foreach ($addonMain as $item) {

            $addonPrices[$item->kode] = $item->harga;
        }

        if ($produk->kode == 'lemari1') {
            # code...
            return view('customer.shopping.produkCustom.lemari1.h1lemari1', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produk]);
        } else if ($produk->kode == 'lemari2') {
            return view('customer.shopping.produkCustom.lemari2.Ch1lemari2', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produk]);
        } else if ($produk->kode == 'lemari3') {
            return view('customer.shopping.produkCustom.lemari3.Ch1lemari3', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produk]);
        }
    }


    public function Htrans(Request $request)
    {

        $user = $this->getLogUser();

        $imageData = $request->image;

        //buat nama file unik
        $fileName = uniqid() . '.png';

        //hapus prefix 'data:image/png;base64,'
        $imageData = str_replace('data:image/png;base64', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);

        $image = base64_decode($imageData);

        $filePath = 'public/hasilcustom/' . $fileName;
        Storage::put($filePath, $image);

        $trans = HTrans::where('id_user', $request->id_user)
            ->where('status', 0)
            ->first();

        if ($trans) {

            $image_path = public_path('storage/hasilcustom/' . $trans->fotoh1);
            unlink($image_path);
            // If found, update the existing transaction
            $trans->update([
                'id_toko' => $request->id_toko,
                'id_produk' => $request->id_produk,
                'fotoh1' => $fileName,
                'nama_produk' => $request->nama_produk,
                'tgl_transaksi' => now(),
                'panjang' => $request->panjang,
                'tinggi' => $request->tinggi,
                'jenis_kayu' => $request->jenis_kayu,
                'harga_kayu' => $request->harga_kayu
            ]);
        } else {
            // If no transaction found with status 0, create a new transaction
            $trans = HTrans::create([
                'id_toko' => $request->id_toko,
                'id_user' => $request->id_user,
                'id_produk' => $request->id_produk,
                'nama_produk' => $request->nama_produk,
                'jumlah' => $request->jumlah,
                'tipe_trans' => $request->tipe_trans,
                'perkiraan_harga' => 0,
                'harga' => 0,
                'fotoh1' => $fileName,
                'fotoh2' => '',
                'status' => $request->status,
                'tgl_transaksi' => now(),
                'panjang' => $request->panjang,
                'tinggi' => $request->tinggi,
                'jenis_kayu' => $request->jenis_kayu,
                'harga_kayu' => $request->harga_kayu

            ]);
        }





        return response()->json(['success' => true, 'file_path' => $filePath]);
    }

    public function finalHTrans(Request $request)
    {
        $user = $this->getLogUser();

        $imageData = $request->image;
        $h_trans_id = $request->input('h_trans_id');
        $sekatHorizontal = $request->input('sekatHorizontal');
        $sekatVertical = $request->input('sekatVertical');
        $gantungan = $request->input('gantungan');
        $laciKecil = $request->input('laciKecil');
        $laciBesar = $request->input('laciBesar');
        $pintu = $request->input('pintu'); // Ambil data pintu
        $pintuPrice = $request->input('pintuPrice');
        $addonPrices = $request->input('addonPrices');
        $catatan = $request->input('catatan');



        //buat nama file unik
        $fileName = uniqid() . '.png';

        //hapus prefix 'data:image/png;base64,'
        $imageData = str_replace('data:image/png;base64', '', $imageData);
        $imageData = str_replace(' ', '+', $imageData);

        $image = base64_decode($imageData);

        $filePath = 'public/hasilcustom/' . $fileName;
        Storage::put($filePath, $image);

        $trans = HTrans::where('id_user', $user->id)
            ->where('status', 0)
            ->first();

        if ($trans) {
            // If found, update the existing transaction
            $trans->update([

                'fotoh2' => $fileName,
                'perkiraan_harga' => $request->total_harga,
                'status' => $request->status,
                'catatan' => $catatan,
                'alamat' => $request->alamat,
                'nomorTelepon' => $request->notelp
            ]);

            if ($pintu) {
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => $pintu,
                    'jumlah' => 1, // Anggap 1 pintu per transaksi
                    'harga' => $pintuPrice,
                    'jenis' => 'second',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }

            // Simpan data add-on Sekat Horizontal jika ada
            if ($sekatHorizontal) {
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => 'Sekat Horizontal',
                    'jumlah' => $sekatHorizontal,
                    'harga' => $addonPrices['sekatHorizontal'], // Gunakan harga dari halaman 1
                    'jenis' => 'main',
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
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            if ($laciKecil) {
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => 'Laci Kecil',
                    'jumlah' => $laciKecil,
                    'harga' => $addonPrices['laciKecil'], // Gunakan harga dari halaman 1
                    'jenis' => 'main',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
            if ($laciBesar) {
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => 'Laci Besar',
                    'jumlah' => $laciBesar,
                    'harga' => $addonPrices['laciBesar'], // Gunakan harga dari halaman 1
                    'jenis' => 'main',
                    'created_at' => now(),
                    'updated_at' => now()
                ]);
            }
        }




        toast('Pembelian Berhasil', 'success');
        return response()->json(['success' => true, 'file_path' => $filePath]);
    }
}
