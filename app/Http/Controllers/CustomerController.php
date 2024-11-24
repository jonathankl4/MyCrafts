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
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Midtrans\Config;
use Midtrans\Notification;
use Midtrans\Transaction;
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


        $random1 = $listproduk->shuffle()->take(4);

        $query = DB::table('produk_custom_dijuals as pcd')
            ->join('detail_produk_custom_dijuals as dpcd', 'pcd.id', '=', 'dpcd.id_produk_custom_dijual')
            ->where('pcd.status', '=', 'aktif')
            ->where('pcd.deleted', '=', 0)
            ->select([
                'pcd.id',
                'pcd.nama_template',
                'pcd.nama_produk',
                'pcd.deskripsi',
                'pcd.panjang_min',
                'pcd.panjang_max',
                'pcd.tinggi_min',
                'pcd.tinggi_max',
                'pcd.lebar_min',
                'pcd.lebar_max',
                'pcd.kode',
                DB::raw('MIN(dpcd.harga) as min_harga'),
                DB::raw('MAX(dpcd.harga) as max_harga'),
                DB::raw('GROUP_CONCAT(DISTINCT dpcd.jenis_kayu) as jenis_kayu_list')
            ])
            ->groupBy([
                'pcd.id',
                'pcd.nama_template',
                'pcd.nama_produk',
                'pcd.deskripsi',
                'pcd.panjang_min',
                'pcd.panjang_max',
                'pcd.tinggi_min',
                'pcd.tinggi_max',
                'pcd.lebar_min',
                'pcd.lebar_max',
                'pcd.kode'
            ])->get();
        $random2 = $query->shuffle()->take(4);


        return view("customer.shopping.dashboard", ['user' => $user, 'listProduk' => $listproduk, 'random1' => $random1, 'random2' => $random2,]);
        // return view("customer.dashboard", ['user'=>$user]);

        // dd($user);
    }

    public function exploreProduk(Request $request)
    {
        $user = $this->getLogUser();

        $query = DB::table('produk_dijuals')->where('status', '=', 'aktif');

        // Handle Search
        if ($request->has('search')) {
            $query->where('nama_produk', 'like', '%' . $request->search . '%');
        }

        // Handle Price Filter
        if ($request->has('price_range')) {
            switch ($request->price_range) {
                case '0-100000':
                    $query->whereBetween('harga_produk', [0, 100000]);
                    break;
                case '100000-500000':
                    $query->whereBetween('harga_produk', [100000, 500000]);
                    break;
                case '500000-1000000':
                    $query->whereBetween('harga_produk', [500000, 1000000]);
                    break;
                case '1000000+':
                    $query->where('harga_produk', '>', 1000000);
                    break;
            }
        }

        // Handle Type Filter
        if ($request->has('tipe_produk') && $request->tipe_produk != 'all') {
            $query->where('tipe_produk', $request->tipe_produk);
        }

        // Handle Sort
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('harga_produk', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('harga_produk', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        }

        $listProduk = $query->paginate(8)->appends(request()->query());

        // Get unique product types for filter
        $productTypes = DB::table('produk_dijuals')
            ->select('tipe_produk')
            ->where('status', '=', 'aktif')
            ->whereNotNull('tipe_produk')
            ->distinct()
            ->pluck('tipe_produk');

        return view('customer.shopping.exploreProduk', [
            'user' => $user,
            'listProduk' => $listProduk,
            'productTypes' => $productTypes,
            'filters' => $request->all()
        ]);
    }


    public function exploreCustomProduk(Request $request)
    {
        $user = $this->getLogUser();

        // Base query untuk produk custom
        $query = DB::table('produk_custom_dijuals as pcd')
            ->join('detail_produk_custom_dijuals as dpcd', 'pcd.id', '=', 'dpcd.id_produk_custom_dijual')
            ->where('pcd.status', '=', 'aktif')
            ->where('pcd.deleted', '=', 0)
            ->select([
                'pcd.id',
                'pcd.nama_template',
                'pcd.nama_produk',
                'pcd.deskripsi',
                'pcd.panjang_min',
                'pcd.panjang_max',
                'pcd.tinggi_min',
                'pcd.tinggi_max',
                'pcd.lebar_min',
                'pcd.lebar_max',
                'pcd.kode',
                DB::raw('MIN(dpcd.harga) as min_harga'),
                DB::raw('MAX(dpcd.harga) as max_harga'),
                DB::raw('GROUP_CONCAT(DISTINCT dpcd.jenis_kayu) as jenis_kayu_list')
            ])
            ->groupBy([
                'pcd.id',
                'pcd.nama_template',
                'pcd.nama_produk',
                'pcd.deskripsi',
                'pcd.panjang_min',
                'pcd.panjang_max',
                'pcd.tinggi_min',
                'pcd.tinggi_max',
                'pcd.lebar_min',
                'pcd.lebar_max',
                'pcd.kode'
            ]);

        // Handle Search
        if ($request->has('search')) {
            $query->where(function ($q) use ($request) {
                $q->where('pcd.nama_template', 'like', '%' . $request->search . '%')
                    ->orWhere('pcd.nama_produk', 'like', '%' . $request->search . '%');
            });
        }

        // Handle Wood Type Filter
        if ($request->has('jenis_kayu') && $request->jenis_kayu != 'all') {
            $query->where('dpcd.jenis_kayu', $request->jenis_kayu);
        }

        // Handle Price Range Filter
        if ($request->has('price_range')) {
            switch ($request->price_range) {
                case '0-1000000':
                    $query->having('min_harga', '<=', 1000000);
                    break;
                case '1000000-2000000':
                    $query->having('min_harga', '>=', 1000000)
                        ->having('max_harga', '<=', 2000000);
                    break;
                case '2000000-3000000':
                    $query->having('min_harga', '>=', 2000000)
                        ->having('max_harga', '<=', 3000000);
                    break;
                case '3000000+':
                    $query->having('max_harga', '>', 3000000);
                    break;
            }
        }

        // Handle Size Filter
        if ($request->has('size_range')) {
            switch ($request->size_range) {
                case 'small':
                    $query->where('pcd.panjang_max', '<=', 100)
                        ->where('pcd.lebar_max', '<=', 100);
                    break;
                case 'medium':
                    $query->whereBetween('pcd.panjang_max', [101, 200])
                        ->whereBetween('pcd.lebar_max', [101, 200]);
                    break;
                case 'large':
                    $query->where('pcd.panjang_max', '>', 200)
                        ->orWhere('pcd.lebar_max', '>', 200);
                    break;
            }
        }

        // Handle Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $query->orderBy('min_harga', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('max_harga', 'desc');
                    break;
                case 'newest':
                    $query->orderBy('pcd.created_at', 'desc');
                    break;
            }
        } else {
            // Default sorting
            $query->orderBy('pcd.created_at', 'desc');
        }

        // Get unique wood types for filter
        $woodTypes = DB::table('detail_produk_custom_dijuals')
            ->select('jenis_kayu')
            ->distinct()
            ->pluck('jenis_kayu');

        // Get addons


        $listProduk = $query->paginate(8)->appends(request()->query());

        return view('customer.shopping.exploreProdukCustom', [
            'user' => $user,
            'listProduk' => $listProduk,
            'woodTypes' => $woodTypes,

            'filters' => $request->all()
        ]);
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
        if ($produk->kode == 'meja1') {
            $foto[] = 'img/meja1/meja1.png';
            $foto[] = 'img/meja1/mj.png';
            $foto[] = 'img/meja1/meja1ViewAtas.png';
            $foto[] = 'img/meja1/meja1belakang.png';
        }
        if ($produk->kode == 'meja2') {
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

    public function pesananSampai(Request $request)
    {

        $pembelian = Htrans::find($request->id);
        $pembelian->status = 12;
        $pembelian->save();


        toast("Konfirmasi Pesanan Sampai diterima", 'success');
        return redirect()->back();
    }

    public function pesananSelesai(Request $request)
    {

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
        } else if ($pembelian->pilihan == 'baru') {
            # code...
            $total = $pembelian->harga_redesain + $pembelian->ongkir;
            $toko->saldo += $total;
            $toko->saldo_pending -= $total;
            $toko->save();
        }



        toast("Pesanan Selesai", 'success');
        return redirect()->back();
    }

    public function pengajuanRetur(Request $request)
    {
        $pembelian = Htrans::find($request->id);
        $pembelian->status = 13;
        $pembelian->alasan_retur = $request->alasanretur;
        $pembelian->save();


        toast("Retur Berhasil diajukan", 'success');
        return redirect()->back();
    }

    public function kirimBalik(Request $request)
    {
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

        $tempPembelian = DB::table('h_trans')
            ->where('id_user', $user->id)
            ->where('status_pembayaran', 0)
            ->where(function ($query) {
                $query->where('status', 2)
                    ->orWhere('status', 3);
            })
            ->orderBy('tgl_transaksi', 'desc')
            ->get();
        // dd($tempPembelian);
        // cek pembayaran
        for ($i = 0; $i < count($tempPembelian); $i++) {
            # code...
            $id = $tempPembelian[$i]->id;
            $htrans = Htrans::find($id);
            $data1 = DB::table('donations')->where('h_trans_id', $id)->where('pilihan', 'awal')->first();

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
                    // return redirect()->back()->withErrors('Unable to verify payment status: ' . $e->getMessage());
                }
            }
        }



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
                } elseif ($subStatus == 'siap_dikirim') {
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
                    ->whereIn('status', [8, 9, 10]) // Misal status 6 adalah tidak berhasil
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

    public function checkPaymentStatus($snaptoken)
    {
        try {
            // Konfigurasi Midtrans (ganti dengan credential-mu)
            Config::$serverKey = 'SB-Mid-server-zWY27q_HmwwGCT9KH8YUuapt';
            Config::$isProduction = config('midtrans.is_production');
            Config::$isSanitized = config('midtrans.is_sanitized');
            Config::$is3ds = config('midtrans.is_3ds');

            // Ambil status transaksi dari Midtrans
            $status = Transaction::status($snaptoken);

            // Kembalikan status pembayaran
            return $status->transaction_status;
        } catch (Exception $e) {
            // Tangani error jika terjadi
            Log::error('Error checking payment status: ' . $e->getMessage());
            return $e->getMessage();
        }
    }

    public function detailTransaksiCustom($id)
    {

        $user = $this->getLogUser();

        $htrans = HTrans::find($id);
        $toko = toko::find($htrans->id_toko);
        $dtrans = DB::table('d_trans')->where('h_trans_id', $id)->get();

        $data1 = DB::table('donations')->where('h_trans_id', $id)->where('pilihan', 'awal')->first();
        $data2 = DB::table('donations')->where('h_trans_id', $id)->where('pilihan', 'baru')->first();

        $statusPembayaran1 = $this->checkPaymentStatus($data1->code);
        $statusPembayaran2 = $this->checkPaymentStatus($data2->code);
        if ($htrans->status_pembayaran == 0) {
            # code...
            if ($statusPembayaran1 == 'settlement') {
                // Pembayaran pertama berhasil
                $htrans->pilihan = 'awal';
                $htrans->status = 4;
                $toko->saldo_pending += $htrans->harga;
                $htrans->status_pembayaran = 1;
                $htrans->save();
                $toko->save();
            }

            if ($statusPembayaran2 == 'settlement') {
                // Pembayaran kedua berhasil
                $htrans->pilihan = 'baru';
                $htrans->status = 4;
                $toko->saldo_pending += $htrans->harga_redesain;
                $htrans->status_pembayaran = 1;
                $htrans->save();
                $toko->save();
            }
        }

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
        $toko = toko::find($htrans->id_toko);
        $dtrans = DB::table('d_trans')->where('h_trans_id', $id)->get();
        $data1 = DB::table('donations')->where('h_trans_id', $id)->first();
        // dd($data1);

        $statusPembayaran1 = $this->checkPaymentStatus($data1->code);

        if ($statusPembayaran1 == 'settlement') {
            // Pembayaran pertama berhasil
            $htrans->pilihan = 'awal';
            $htrans->status = 4;
            $toko->saldo_pending += $htrans->harga;
            $htrans->status_pembayaran = 1;
            $htrans->save();
            $toko->save();
        }

        // Check if there's a related donation and if payment has expired
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
        } else if ($produk->kode == 'meja1') {
            return view('customer.shopping.produkCustom.meja1.Ch1Meja1', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produk]);
        } else if ($produk->kode == 'meja2') {
            return view('customer.shopping.produkCustom.meja2.Ch1Meja2', ['user' => $user, 'detail' => $detail, 'addonPrices' => $addonPrices, 'listAddOnMain' => $addonMain, 'produk' => $produk]);
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
        $harga_finishing = $request->input('harga_finishing');


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
                'finishing' => $finishing,
                'harga_finishing' => $harga_finishing
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




        // toast('Pembelian Berhasil', 'success');
        return response()->json(['success' => true, 'file_path' => $filePath]);
    }

    public function checkoutCustom()
    {

        $user = $this->getLogUser();


        $trans = HTrans::where('id_user', $user->id)
            ->where('status', 0)
            ->first();

        $produk = ProdukCustomDijual::find($trans->id_produk);



        return view('customer.shopping.produkCustom.checkout', ['user' => $user, 'trans' => $trans, 'produk' => $produk]);
    }

    public function doneCheckOut(Request $request)
    {


        $user = $this->getLogUser();

        $trans = Htrans::find($request->id);

        $trans->alamat = $request->alamat;
        $trans->nomorTelepon = $request->nomorTelp;
        $trans->status = 1;

        $trans->save();

        toast('Pembelian Berhasil', 'success');
        return redirect(url('/customer/pembelian'));
    }
}
