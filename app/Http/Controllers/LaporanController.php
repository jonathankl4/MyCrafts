<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\MutasiBarang;
use App\Models\PenggunaanBahan;
use App\Models\Retur;
use App\Models\toko;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class LaporanController extends Controller
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

    // Laporan Pembelian


    public function indexLaporanPembelian (Request $request)
    {
        $user = $this->getLogUser();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');


        $query = DB::table('detail_pencatatan_pembelians as dpp')
            ->select('dpp.nama_barang', 'dpp.jumlah', 'dpp.satuan', 'dpp.harga', 'dpp.total_harga', 'pp.tanggal')
            ->join('pencatatan_pembelians as pp', 'dpp.id_pencatatan', '=', 'pp.id')
            ->where('pp.status', 1)
            ->where('pp.id_toko', $user->id_toko);

        if ($startDate && $endDate) {
            $query->whereBetween('pp.tanggal', [$startDate, $endDate]);
        }

        $laporanPembelian = $query->orderBy('pp.tanggal', 'asc')->get();

        return view('seller.laporan.laporanPembelianBahan', [
            'user' =>$user,
            'laporanPembelian' => $laporanPembelian,
            'startDate' => $startDate,
            'endDate' => $endDate,
        ]);
    }

    public function indexLaporanMutasi( Request $request){
        $user = $this->getLogUser();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $laporanMutasi = DB::table('mutasi_barangs as mb')
            ->select(
                'mb.nama_barang',
                'mb.stok_masuk',
                'mb.stok_keluar',
                'mb.jenis_mutasi',
                'mb.jenis_barang',
                'b.nama_bahan',
                'm.nama_mebel',
                'mb.tanggal'
            )
            ->leftJoin('bahans as b', 'mb.id_bahan', '=', 'b.id')
            ->leftJoin('mebels as m', 'mb.id_mebel', '=', 'm.id')
            ->where('mb.id_toko', $user->id_toko);

        if ($startDate && $endDate) {
            $laporanMutasi->whereBetween('mb.tanggal', [$startDate, $endDate]);
        }

        $laporanMutasi = $laporanMutasi->orderBy('mb.tanggal')
            ->get();

        return view('seller.laporan.laporanMutasi', [
            'user' => $user,
            'laporanMutasi' => $laporanMutasi,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

    }

    public function indexLaporanStokBahan(){

        $user = $this->getLogUser();
        $stokBahan = Bahan::all(); // Mengambil semua data dari tabel bahans

        return view('seller.laporan.laporanStokBahan', [
            'user' => $user,
            'stokBahan' => $stokBahan,
        ]);
    }

    public function indexLaporanPenjualan( Request $request){
        $user = $this->getLogUser();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $tipeTrans = $request->input('tipe_trans');

        $laporanPenjualan = DB::table('h_trans as ht')
            ->select(
                'ht.tgl_transaksi',
                'ht.nama_produk',
                'ht.tipe_trans',
                'ht.jumlah',
                'ht.harga',
                'ht.harga_redesain',
                'ht.ongkir',
                'ht.status'
            )

            ->whereIn('ht.status', [7, 8, 9, 10, 16])
            ->where('ht.id_toko', $user->id_toko);

        if ($startDate && $endDate) {
            $laporanPenjualan->whereBetween('ht.tgl_transaksi', [$startDate, $endDate]);
        }

        if ($tipeTrans) {
            $laporanPenjualan->where('ht.tipe_trans', $tipeTrans);
        }

        $laporanPenjualan = $laporanPenjualan->orderBy('ht.tgl_transaksi')
            ->get();



        return view('seller.laporan.laporanPenjualan', [
            'user'=> $user,
            'laporanPenjualan' => $laporanPenjualan,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'tipeTrans' => $tipeTrans
        ]);
    }

    public function indexLaporanProduksi(Request $request){


        $user = $this->getLogUser();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');


        $laporanProduksi = DB::table('rencana_produksis as rp')
            ->select(
                'rp.tgl_produksi_mulai',
                'rp.tgl_produksi_selesai',
                'rp.nama_produk',
                'rp.jumlahdiproduksi',
                'hp.jumlah_berhasil',
                'hp.jumlah_gagal',
                'hp.durasi',

            )
            ->leftJoin('hasil_produksis as hp', 'rp.id', '=', 'hp.id_produksi')
            ->where('rp.status', 2)
            ->where('rp.id_toko', $user->id_toko);

        if ($startDate && $endDate) {
            $laporanProduksi->whereBetween('rp.tgl_produksi_mulai', [$startDate, $endDate]);
        }

        $laporanProduksi = $laporanProduksi->orderBy('rp.tgl_produksi_mulai')
            ->get();

        return view('seller.laporan.laporanProduksi', [
            'user'=>$user,
            'laporanProduksi' => $laporanProduksi,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);

    }

    public function indexLaporanGagalProduksi (Request $request){
        $user = $this->getLogUser();
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        $laporanGagalProduksi = DB::table('rencana_produksis as rp')
            ->select(
                'rp.tgl_produksi_mulai',
                'rp.tgl_produksi_selesai',
                'rp.nama_produk',
                'rp.jumlahdiproduksi',
                'hp.jumlah_berhasil',
                'hp.jumlah_gagal',
                'hp.durasi',

            )
            ->leftJoin('hasil_produksis as hp', 'rp.id', '=', 'hp.id_produksi')

            ->where('rp.status', 2)
            ->where('rp.id_toko', $user->id_toko);


        if ($startDate && $endDate) {
            $laporanGagalProduksi->whereBetween('rp.tgl_produksi_mulai', [$startDate, $endDate]);
        }

        $laporanGagalProduksi = $laporanGagalProduksi->orderBy('rp.tgl_produksi_mulai')
            ->get();

        return view('seller.laporan.laporanGagalProduksi', [
            'user' => $user,
            'laporanGagalProduksi' => $laporanGagalProduksi,
            'startDate' => $startDate,
            'endDate' => $endDate
        ]);
    }

    public function indexLaporanRetur(Request $request)
    {
        $user = $this->getLogUser();
        $startDate = $request->input('start_date', now()->subYear()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        $status = $request->input('status', '');

        // Konversi tanggal ke format datetime untuk lingkup pencarian penuh
        $query = Retur::where('id_toko', $user->id_toko);

        // Tambahkan filter tanggal hanya jika keduanya diisi
        if (!empty($startDate) && !empty($endDate)) {
            $query->whereDate('tgl_retur', '>=', $startDate)
                  ->whereDate('tgl_retur', '<=', $endDate);
        }

        // dd($status);
        // Filter status jika dipilih
        if ($status !== '' && $status !== null) {
            $query->where('status', $status);
        }

        $laporanRetur = $query->get();


            // dd($laporanRetur);
        return view('seller.laporan.laporanRetur', [
            'laporanRetur' => $laporanRetur,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'status' => $status,
            'user' =>$user
        ]);
    }

    public function indexLaporanPenggunaanBahan(Request $request)
    {
        $user = $this->getLogUser();

        $startDate = $request->input('start_date', now()->subMonth()->format('Y-m-d'));
        $endDate = $request->input('end_date', now()->format('Y-m-d'));
        $status = $request->input('status', '');

        $query = PenggunaanBahan::whereHas('rencanaProduksi', function($q) use ($user, $startDate, $endDate, $status) {
            $q->where('id_toko', $user->id_toko)
              ->whereDate('tgl_produksi_mulai', '>=', $startDate)
              ->whereDate('tgl_produksi_mulai', '<=', $endDate);


                $q->where('status', 2);

        });

        $laporanPenggunaanBahan = $query->with('rencanaProduksi')->get();

        return view('seller.laporan.laporanPenggunaanBahan', [
            'laporanPenggunaanBahan' => $laporanPenggunaanBahan,
            'startDate' => $startDate,
            'endDate' => $endDate,
            'status' => $status,
            'user' =>$user
        ]);
    }
}
