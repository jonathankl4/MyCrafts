<?php

namespace App\Http\Controllers;

use App\Models\Pengiriman;
use App\Models\Toko;
use App\Models\Pelanggan;
use App\Models\Mebel;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PengirimanController extends Controller
{

    public function getLogUser()
    {
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    public function index()
    {
        $user = $this->getLogUser();
        $pengiriman = Pengiriman::with(['mebel'])->paginate(10);
        return view('seller.gudang.pengiriman.pengiriman', compact('pengiriman', 'user'));
    }

    public function create()
    {
        $user = $this->getLogUser();
        $mebels = Mebel::where('id_toko', $user->id_toko)->get();
        return view('seller.gudang.pengiriman.formPengiriman', compact('mebels', 'user'));
    }

    public function store(Request $request)
    {
        $user = $this->getLogUser();
        $validatedData = $request->validate([


            'id_mebel' => 'required',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengiriman' => 'required|date',
            'alamat' => 'required|string',
            'jasa_pengiriman' => 'nullable|string',
            'nomor_resi' => 'nullable|string',
            'biaya_pengiriman' => 'required|numeric|min:0',
            'nama_penerima' => 'required|string'
        ]);
        $validatedData['id_toko'] = $user->id_toko;


        Pengiriman::create($validatedData);

        return redirect()->route('pengiriman.index')
            ->with('success', 'Pengiriman berhasil ditambahkan');
    }

    public function edit(Pengiriman $pengiriman)
    {
        $user = $this->getLogUser();
        $mebels = Mebel::where('id_toko', $user->id_toko)->get();
        return view('seller.gudang.pengiriman.editPengiriman', compact('pengiriman','mebels', 'user'));
    }

    public function update(Request $request, Pengiriman $pengiriman)
    {
        $validatedData = $request->validate([
            'nama_penerima' => 'required|string',
            'id_mebel' => 'required|exists:mebels,id',
            'jumlah' => 'required|integer|min:1',
            'tanggal_pengiriman' => 'required|date',
            'alamat' => 'required|string',
            'jasa_pengiriman' => 'nullable|string',
            'nomor_resi' => 'nullable|string',
            'biaya_pengiriman' => 'required|numeric|min:0'
        ]);

        $pengiriman->update($validatedData);

        toast('berhasil Update', 'success');
        return redirect()->route('pengiriman.index');

    }

    public function destroy(Pengiriman $pengiriman)
    {
        $pengiriman->delete();

        return redirect()->route('pengiriman.index')
            ->with('success', 'Pengiriman berhasil dihapus');
    }

    public function show(Pengiriman $pengiriman)
    {
        $user = $this->getLogUser();
        return view('seller.gudang.pengiriman.showPengiriman', compact('pengiriman', 'user'));
    }
}


