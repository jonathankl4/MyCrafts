<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\HTrans;
use App\Models\Post;
use App\Models\ProdukCustomDijual;
use App\Models\ProdukDijual;
use App\Models\satuan;
use App\Models\tester;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
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
        $toko->status = "Free";
        $toko->save();


        $user->id_toko = $toko->id;
        $user->save();

        $s = [];
        $s[] = 'cm';
        $s[] = 'kg';
        $s[] = 'meter';

        for ($i = 0; $i < count($s); $i++) {
            # code...
            $satuan = new satuan();
            $satuan->id_toko = $user->id_toko;
            $satuan->nama_satuan = $s[$i];
            $satuan->save();
        }

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

    public function detailProdukCustom($id)
    {
        $user = $this->getLogUser();
        $produk = ProdukCustomDijual::find($id);

        $detail = DB::table('detail_produk_custom_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->get();
        $addonMain = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->where('jenis', '=', 'main')->get();
        $addonSec = DB::table('detail_addon_dijuals')->where('id_produk_custom_dijual', '=', $produk->id)->where('jenis', '=', 'second')->get();

        $foto = [];


        if ($produk->kode == "lemari1") {
            $foto[] = 'img/lemari1/lemari1.png';
            $foto[] = 'img/lemari1/lemari1samping.png';
            $foto[] = 'img/lemari1/lemari1bawah.png';
        }
        if ($produk->kode == 'lemari2') {
            $foto[] = 'img/lemari2/lemari2.png';
            $foto[] = 'img/lemari2/lemari2samping.png';
            $foto[] = 'img/lemari2/lemari2belakang.png';
            $foto[] = 'img/lemari2/lemari2bawah.png';
        }
        if ($produk->kode == 'lemari3') {
            $foto[] = 'img/lemari3/lemari3.png';
            $foto[] = 'img/lemari3/lemari3samping.png';
            $foto[] = 'img/lemari3/lemari3belakang.png';
            $foto[] = 'img/lemari3/lemari3bawah.png';
        }
        if ($produk->kode == 'meja1'){
            $foto[] = 'img/meja1/meja1.png';
            $foto[] = 'img/meja1/mj.png';
            $foto[] = 'img/meja1/meja1ViewAtas.png';
            $foto[] = 'img/meja1/meja1belakang.png';
        }
        if ($produk->kode == 'meja2'){
            $foto[] = 'img/meja2/meja2.png';
            $foto[] = 'img/meja2/meja2samping.png';
            $foto[] = 'img/meja2/meja2atas.png';

        }
        return view("customer.shopping.produkCustom.produkCustomDetail", ['user' => $user, 'produk' => $produk, 'foto' => $foto, 'detail' => $detail, 'addonMain' => $addonMain, 'addonSec' => $addonSec]);
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
            'status' => 1,
            'tgl_transaksi' => now(),
            'catatan' => $request->catatan,
            'alamat' => $request->alamat,
            'nomorTelepon' => $request->nomorTelp

        ]);

        // dd($trans->id);

        toast('transaksi berhasil, silahkan tunggu konfirmasi penjual', 'success');
        return redirect(url('/detailTransaksiNonCustom/' . $trans->id));
    }

    public function pembayaran(Request $request)
    {

        $htrans = Htrans::find($request->idHtrans);
        $toko = toko::find($htrans->id_toko);

        if ($request->pilihan == 'awal') {
            # code...
            $htrans->pilihan = 'awal';
            $htrans->status = 4;
            $toko->saldo_pending += $htrans->harga;
        } else if ($request->pilihan == 'baru') {
            $htrans->pilihan = 'baru';
            $htrans->status = 4;
            $toko->saldo_pending += $htrans->harga_redesain;
        } else if ($request->pilihan == 'jadi') {
            # code...
            $htrans->pilihan = 'jadi';
            $htrans->status = 11;
            $toko->saldo_pending += $htrans->harga;
        }
        $htrans->status_pembayaran = 1;
        $htrans->save();
        $toko->save();

        return response()->json(['status' => 'success']);
    }

    public function pesananSampai(Request $request){

        $pembelian = Htrans::find($request->id);
        $pembelian->status = 12;
        $pembelian->save();


        toast("Konfirmasi Pesanan Sampai diterima", 'success');
        return redirect()->back();
    }

    public function pesananSelesai(Request $request){

        $pembelian = Htrans::find($request->id);
        $pembelian->status = 7;
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



        toast("Pesanan Selesai", 'success');
        return redirect()->back();
    }

    public function pengajuanRetur(Request $request){
        $pembelian = Htrans::find($request->id);
        $pembelian->status = 13;
        $pembelian->alasan_retur = $request->alasanretur;
        $pembelian->save();


        toast("Retur Berhasil diajukan", 'success');
        return redirect()->back();
    }

    public function kirimBalik(Request $request){
        $pembelian = Htrans::find($request->id);
        $pembelian->status = 15;
        $pembelian->nomor_resi = $request->ResiBalik;
        $pembelian->save();


        toast("Retur Berhasil diajukan", 'success');
        return redirect()->back();

    }

    public function listPembelian(Request $request)
    {
        $user = $this->getLogUser();

        $status = $request->query('status', 'semua');
        $subStatus = $request->query('sub_status', null);

        switch ($status) {
            case 'berjalan':
                // Filter berdasarkan sub-status jika ada
                $query = DB::table('h_trans')->where('id_user', $user->id);

                if ($subStatus == 'menunggu_konfirmasi') {
                    $query->whereIn('status', [1]); // Misal status 1 adalah Menunggu Konfirmasi
                } elseif ($subStatus == 'menunggu_pembayaran') {
                    $query->whereIn('status', [2, 3]);
                }
                elseif ($subStatus == 'siap_dikirim') {
                    $query->where('status', 11); // Misal status 2 adalah Siap Dikirim
                } elseif ($subStatus == 'sedang_produksi') {
                    $query->whereIn('status', [4, 5]); // Misal status 3 adalah Sedang di Produksi
                } elseif ($subStatus == 'dikirim') {
                    $query->where('status', 6); // Misal status 4 adalah Dikirim
                } else {
                    $query->whereIn('status', [1, 2, 3, 4, 5, 6]); // Semua status yang termasuk dalam "berjalan"
                }

                $pembelian = $query->orderBy('tgl_transaksi', 'desc')->get();
                break;

            case 'berhasil':
                $pembelian = DB::table('h_trans')
                    ->where('id_user', $user->id)
                    ->where('status', 7) // Misal status 5 adalah berhasil
                    ->orderBy('tgl_transaksi', 'desc')
                    ->get();
                break;

            case 'tidak_berhasil':
                $pembelian = DB::table('h_trans')
                    ->where('id_user', $user->id)
                    ->whereIn('status', [8, 9 , 10]) // Misal status 6 adalah tidak berhasil
                    ->orderBy('tgl_transaksi', 'desc')
                    ->get();
                break;

            default:
                $pembelian = DB::table('h_trans')
                    ->where('id_user', $user->id)
                    ->where('status', '!=', 0)
                    ->orderBy('tgl_transaksi', 'desc')
                    ->get();
                break;
        }

        return view('customer.shopping.pembelian', ['user' => $user, 'pembelian' => $pembelian, 'status' => $status, 'sub_status' => $subStatus]);
    }

    public function detailTransaksiCustom($id)
    {

        $user = $this->getLogUser();

        $htrans = HTrans::find($id);
        $dtrans = DB::table('d_trans')->where('h_trans_id', $id)->get();

        $data1 = DB::table('donations')->where('h_trans_id', $id)->where('pilihan', 'awal')->first();
        $data2 = DB::table('donations')->where('h_trans_id', $id)->where('pilihan', 'baru')->first();

        if ($htrans->status_pembayaran == 0 && ($htrans->status == 2 || $htrans->status == 3)) {
            // Set up Midtrans configuration
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('midtrans.isProduction');

            try {
                $created_time = strtotime($data1->created_at);
                $current_time = time();
                $time_difference = $current_time - $created_time;

                if ($time_difference > 86400) {
                    # code...
                    $htrans->status =  10;
                    $htrans->status_pembayaran = 3;
                    $htrans->save();
                    DB::table('donations')->where('h_trans_id', $id)
                    ->update(['status' => 'expired']);
                }

            } catch (\Exception $e) {
                // Log or handle the error as necessary
                toast('eror gabisa handle' . $e->getMessage(), 'error');
                return redirect()->back()->withErrors('Unable to verify payment status: ' . $e->getMessage());
            }
        }
        return view('customer.shopping.detailPembelianCustom', ['user' => $user, 'htrans' => $htrans, 'dtrans' => $dtrans, 'data1' => $data1, 'data2' => $data2]);
    }

    public function detailTransaksiNonCustom($id)
    {
        $user = $this->getLogUser();

        // Find the transaction in h_trans
        $htrans = HTrans::find($id);
        $dtrans = DB::table('d_trans')->where('h_trans_id', $id)->get();
        $data1 = DB::table('donations')->where('h_trans_id', $id)->first();
        // dd($data1);

        // Check if there's a related donation and if payment has expired
        if ($htrans->status_pembayaran == 0 && ($htrans->status == 2 || $htrans->status == 3) ) {
            // Set up Midtrans configuration
            \Midtrans\Config::$serverKey = config('midtrans.serverKey');
            \Midtrans\Config::$isProduction = config('midtrans.isProduction');

            try {
                $created_time = strtotime($data1->created_at);
                $current_time = time();
                $time_difference = $current_time - $created_time;

                if ($time_difference > 86400) {
                    # code...
                    $htrans->status =  10;
                    $htrans->status_pembayaran = 3;
                    $htrans->save();
                    DB::table('donations')->where('h_trans_id', $id)
                    ->update(['status' => 'expired']);
                }

            } catch (\Exception $e) {
                // Log or handle the error as necessary
                toast('eror gabisa handle' . $e->getMessage(), 'error');
                return redirect()->back()->withErrors('Unable to verify payment status: ' . $e->getMessage());
            }
        }

        return view('customer.shopping.nonCustom.detailPembelianNonCustom', [
            'user' => $user,
            'htrans' => $htrans,
            'dtrans' => $dtrans,
            'data1' => $data1
        ]);
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
        } else if ($produk->kode == 'meja1'){
            return view('customer.shopping.produkCustom.meja1.Ch1Meja1',['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produk]);
        } else if ($produk->kode == 'meja2'){
            return view('customer.shopping.produkCustom.meja2.Ch1Meja2',['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produk]);
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
                'lebar' => $request->lebar,
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
                'lebar' => $request->lebar,
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
        $laci1 = $request->input('laci1');
        $laci2 = $request->input('laci2');
        $pijakankaki = $request->input('pijakankaki');
        $pintu = $request->input('pintu'); // Ambil data pintu
        $pintuPrice = $request->input('pintuPrice');
        $addonPrices = $request->input('addonPrices');
        $catatan = $request->input('catatan');
        $finishing = $request->input('finishing');


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
                'nomorTelepon' => $request->notelp,
                'finishing' => $finishing
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
            if ($laci1) {
                # code...
                DB::table('d_trans')->insert([
                    'h_trans_id' => $trans->id,
                    'nama_item' => 'Laci 1',
                    'jumlah' => $laci1,
                    'harga' => $addonPrices['laci1'], // Gunakan harga dari halaman 1
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
