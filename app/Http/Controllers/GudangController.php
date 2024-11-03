<?php

namespace App\Http\Controllers;

use App\Models\Bahan;
use App\Models\DetailPermintaanPembelian;
use App\Models\Mebel;
use App\Models\MutasiBarang;
use App\Models\PermintaanPembelian;
use App\Models\toko;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class GudangController extends Controller
{
    //

    public function getLogUser()
    {
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

    public function pageMutasi()
    {


        $user = $this->getLogUser();

        $riwayat = DB::table('mutasi_barangs')->where('id_toko', $user->id_toko)->orderBy('id', 'desc')->get();
        $mebel = DB::table('mebels')->where('id_toko', $user->id_toko)->get();
        $bahan = DB::table('bahans')->where('id_toko', $user->id_toko)->get();
        return view('seller.gudang.mutasiBarang.riwayatMutasi', ['user' => $user, 'riwayat' => $riwayat, 'listBahan' => $bahan, 'listMebel' => $mebel]);
    }

    public function getStokMebel($id)
    {
        // Ambil stok barang berdasarkan ID
        $mebel = Mebel::find($id);

        return response()->json([
            'stok_sekarang' => $mebel ? $mebel->jumlah_mebel : 0
        ]);
    }
    public function getStokBahan($id)
{
    $bahan = Bahan::find($id);
    return response()->json([
        'stok_sekarang' => $bahan ? $bahan->jumlah_bahan : 0,
        'satuan' =>$bahan->satuan_jumlah
    ]);
}

    public function storeMutasiMebel(Request $request)
    {

        $user = $this->getLogUser();
        $nama = '';
        $jenisBarang = '';

        // Ambil data mebel berdasarkan ID
        if ($request->jenis_barang == 'mebel') {
            $mebel = Mebel::find($request->id_mebel);
            if ($request->jenis_mutasi == 'keluar') {
                $mebel->jumlah_mebel -= $request->jumlah;
            } elseif ($request->jenis_mutasi == 'masuk') {
                $mebel->jumlah_mebel += $request->jumlah;
            }
            $nama = $mebel->nama_mebel;
            $jenisBarang = 'Mebel';
            $mebel->save();
        } elseif ($request->jenis_barang == 'bahan') {
            $bahan = Bahan::find($request->id_bahan);
            if ($request->jenis_mutasi == 'keluar') {
                $bahan->jumlah_bahan -= $request->jumlah;
            } elseif ($request->jenis_mutasi == 'masuk') {
                $bahan->jumlah_bahan += $request->jumlah;
            }
            $nama = $bahan->nama_bahan;
            $jenisBarang = 'Bahan';
            $bahan->save();
        }


        // Simpan data mutasi

        $mutasi = new MutasiBarang();
        $mutasi->id_toko = $user->id_toko;
        $mutasi->nama_barang = $nama;
        $mutasi->stok_masuk = $request->jenis_mutasi == 'masuk' ? $request->jumlah : null;
        $mutasi->stok_keluar = $request->jenis_mutasi == 'keluar' ? $request->jumlah : null;
        $mutasi->jenis_mutasi = $request->jenis_mutasi;
        $mutasi->jenis_barang = $jenisBarang;
        $mutasi->save();

        toast('Berhasil tambah Mutasi', 'success');
        return redirect()->back();
    }

    public function formPermintaanPembelian(){


        $user = $this->getLogUser();

        $bahan = DB::table('bahans')->where('id_toko', $user->id_toko)->get();

        return view('seller.gudang.permintaanPembelian.formPermintaanPembelian', ['user'=>$user, 'bahans'=>$bahan]);
    }

    public function buatPermintaanPembelian(Request $request){

        $user = $this->getLogUser();
        DB::beginTransaction();
        try {
            $permintaan = new PermintaanPembelian();
            $permintaan->id_toko = $user->id_toko;
            $permintaan->tanggal = now();
            $permintaan->status = 0; // 0: Draft, 1: Disetujui, 2: Ditolak
            $permintaan->save();

            foreach($request->items as $item) {
                $detail = new DetailPermintaanPembelian();
                $detail->id_permintaan = $permintaan->id;
                $detail->nama_barang = $item['nama_barang'];
                $detail->jumlah = $item['jumlah'];
                $detail->satuan = $item['satuan'];
                $detail->harga = $item['harga'];
                $detail->total_harga = $item['jumlah'] * $item['harga'];
                $detail->save();
            }

            DB::commit();
            toast('berhasil tambah permintaan', 'success');
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            toast('gagal tambah', 'error');
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function riwayatPermintaanPembelian(){
        $user = $this->getLogUser();
        $permintaans = PermintaanPembelian::where('id_toko', $user->id_toko)
        ->orderBy('created_at', 'desc')
        ->with('detailPermintaanPembelian')
        ->get();

    return view('seller.gudang.permintaanPembelian.riwayatPermintaanPembelian', compact('permintaans', 'user'));
    }
}
