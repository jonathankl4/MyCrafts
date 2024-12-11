<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\Pegawai;
use App\Models\toko;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use RealRashid\SweetAlert\Facades\Alert;

class SellerController extends Controller
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


    public function homePage(){
        $user = $this->getLogUser();

        $toko = $this->getToko();

        $nonCustom = DB::table('produk_dijuals')->where('id_toko',$toko->id)->where('status', 'aktif')->get();
        $custom = DB::table('produk_custom_dijuals')->where('id_toko',$toko->id)->where('status', 'aktif')->get();

        $currentMonth = Carbon::now()->month; // Mendapatkan bulan saat ini
$currentYear = Carbon::now()->year;

        $penjualan = DB::table('h_trans as ht')
            ->select(
                'ht.tgl_transaksi',
                'ht.nama_produk',
                'ht.tipe_trans',
                'ht.jumlah',
                'ht.harga',
                'ht.harga_redesain',
                'ht.ongkir',
                'ht.status',
                'pilihan'
            )

            ->whereIn('ht.status', [7, 16])
            ->where('ht.id_toko', $user->id_toko)
            ->whereMonth('ht.tgl_transaksi', $currentMonth) // Filter berdasarkan bulan
    ->whereYear('ht.tgl_transaksi', $currentYear)  // Filter berdasarkan tahun
    ->get();

    $totalPenghasilan = $penjualan->sum(function($item) {
        if ($item->pilihan === 'awal') {
            return $item->harga; // Pilihan awal, hitung dari harga
        } elseif ($item->pilihan === 'jadi') {
            return $item->harga; // Pilihan baru, tetap hitung dari harga
        } else {
            return $item->harga_redesain; // Pilihan lain, hitung dari harga_redesain
        }
    });

        // dd(count($custom));
        return view("seller.dashboard", ['user'=>$user, 'toko'=>$toko, 'nonCustom'=>$nonCustom, 'custom'=>$custom, 'totalPenghasilan'=>$totalPenghasilan]);


    }

    public function pengaturanToko(){

        $user = $this->getLogUser();

        $toko = toko::find($user->id_toko);



        return view('seller.toko.pengaturanToko',['user'=>$user, 'toko'=>$toko]);

    }

    public function updateToko(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'slogan' => 'nullable|string|max:255',
            'deskripsi' => 'nullable|string',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $toko = Toko::where('id_owner', auth()->user()->id)->firstOrFail();

        $data = $request->only(['nama', 'slogan', 'deskripsi']);

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($toko->foto) {
                Storage::delete('public/fotoToko/' . $toko->foto);
            }

            // Simpan foto baru
            $fotoPath = $request->file('foto')->store('public/foto-toko');
            $data['foto'] = str_replace('public/foto-toko/', '', $fotoPath);
        }

        $toko->update($data);

        toast('Berhasil Menyimpan Perubahan', 'success');
        return redirect()->back();
    }







    public function pegawaiPage(){

        $user = $this->getLogUser();
        $toko = $this->getToko();

        $pegawai = DB::table('pegawais')
                        ->leftJoin('users', 'pegawais.id_user', '=', 'users.id')
                        ->where('pegawais.id_toko', $toko->id)
                        ->select('pegawais.*', 'users.email')
                        ->get();
        // dd($pegawai);
        return view('seller.pegawai', ['user'=> $user, 'listPegawai'=>$pegawai]);

    }

    public function addPegawai(Request $request){

        $user = DB::table('users')->where('email', $request->email)->first();
        $toko = $this->getToko();

        if ($user) {
            # code...
            if ($user->status == 'owner') {
                # code...
                toast('user sudah terdaftar sebagai seller', 'error');
                return redirect()->back();
            }
            else {
                if ($user->status != 'buyer') {
                    # code...
                    toast('user sedang bekerja di toko lain', 'error');
                    return redirect()->back();
                }
                else if ($user->status == 'buyer') {
                    # code...

                    $p = new Pegawai();
                    $p->id_user = $user->id;
                    $p->id_toko = $toko->id;
                    $p->role = $request->role;
                    $p->save();

                    $u = User::find($user->id);
                    $u->status = 'pegawai-'.$request->role;
                    $u->id_toko = $toko->id;
                    $u->save();
                    toast('User Berhasil ditambahkan', 'success');
                    return redirect()->back();
                }
            }
        }
        else{
            toast('user tidak ditemukan', 'error');
            return redirect()->back();
        }
    }

    public function editPegawai(Request $request, $id){

        $pegawai = Pegawai::find($id);
        $pegawai->role = $request->role;
        $pegawai->save();

        $user = User::find($pegawai->id_user);
        $user->status ='pegawai-'.$request->role;
        $user->save();

        toast('Berhasil ubah role', 'success');
        return redirect()->back();
    }

    public function deletePegawai($id){

        $pegawai = Pegawai::find($id);

        $user = User::find($pegawai->id_user);
        $user->status = 'buyer';
        $user->id_toko = null;
        $user->save();

        $pegawai->delete();
        toast('Berhasil hapus pegawai', 'success');

        return redirect()->back();


    }



}
