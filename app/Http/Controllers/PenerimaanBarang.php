<?php

namespace App\Http\Controllers;

use App\Models\DetailPenerimaanBarang;
use App\Models\Mebel;
use App\Models\PenerimaanBarang as ModelsPenerimaanBarang;
use App\Models\supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use RealRashid\SweetAlert\Facades\Alert;

class PenerimaanBarang extends Controller
{
    //

    public function getLogUser()
    {
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function index()
    {

        $user = $this->getLogUser();
        $penerimaans = ModelsPenerimaanBarang::query()->latest()->get();

        return view('seller.gudang.penerimaanBarang.penerimaanBarang', compact('penerimaans', 'user'));
    }

    public function create()
    {
        $user = $this->getLogUser();
        $suppliers = supplier::query()->where('id_toko', $user->id_toko)->get();
        $barangs = Mebel::query()->where('id_toko', $user->id_toko)->get();
        return view('seller.gudang.penerimaanBarang.formPenerimaanBarang', compact('suppliers', 'barangs', 'user'));
    }

    public function store(Request $request)
    {

        $user = $this->getLogUser();
        $request->validate([
            'tanggal_penerimaan' => 'required|date',
            'jenis_penerimaan' =>'required',
            'barangs' => 'required|array',
            'barangs.*.jumlah' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // Create Penerimaan Barang
            $penerimaan = ModelsPenerimaanBarang::create([
                'id_toko' => $user->id_toko,
                'tanggal_penerimaan' => $request->tanggal_penerimaan,
                'jenis_penerimaan' => $request->jenis_penerimaan,
                'status_penerimaan' => 'Selesai',
                'catatan' => $request->catatan ?? null
            ]);

            // Create Detail Penerimaan Barang
            foreach ($request->barangs as $barangItem) {
                DetailPenerimaanBarang::create([
                    'id_penerimaan' => $penerimaan->id,
                    'id_barang' => $barangItem['id'],
                    'jumlah' => $barangItem['jumlah'],
                    'keterangan' => $barangItem['keterangan'] ?? null
                ]);

                $m = Mebel::find($barangItem['id']);
                $m->jumlah_mebel += $barangItem['jumlah'];
                $m->save();
            }

            DB::commit();
            toast('berhasil tambah', 'success');
            return redirect()->route('penerimaan-barang.index')
                ->with('success', 'Penerimaan Barang berhasil disimpan');
        } catch (\Exception $e) {
            DB::rollBack();
            // toast($e->getMessage(), 'error');
            Alert::error('gagal', $e->getMessage());
            return back()->with('error', 'Gagal menyimpan Penerimaan Barang: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        $user = $this->getLogUser();
        $penerimaan = ModelsPenerimaanBarang::with(['details.barang'])->findOrFail($id);
        return view('seller.gudang.penerimaanBarang.detailPenerimaanBarang', compact('penerimaan', 'user'));
    }
}
