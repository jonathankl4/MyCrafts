<?php

namespace App\Http\Controllers;

use App\Models\AddOn;
use App\Models\DetailAddonDijual;
use App\Models\DetailProdukCustomDijual;
use App\Models\ProdukCustomDijual;
use App\Models\Template;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use RealRashid\SweetAlert\Facades\Alert;

class ProdukCustomController extends Controller
{
    //

    public function getLogUser(){
        $s = Session::get("user");
        $user = User::find($s->id);
        return $user;
    }

    // START OF TEMPLATE
    // halaman daftar template
    public function pageTemplateProduk(){
        $user = $this->getLogUser();
        $template = DB::table('templates')->where("id_toko",'=',$user->id_toko)->get();
        return view("seller.produkCustom.template.daftarTemplate", ['user'=>$user, 'listTemplate'=>$template]);

    }

    public function pageTambahTemplate(){
        $user = $this->getLogUser();
        return view("seller.produkCustom.template.tambahTemplate", ['user'=>$user]);
    }

    public function addTemplate(Request $request){
        $user = $this->getLogUser();

        $request->validate([
            "nama"=>'required',
            "tipe"=>'required',
            "harga"=>'required|integer',
            "keterangan"=>'required',
            "foto"=>'required',

        ],

        ["required" => ":attribute harus di isi",
        "integer" => ":attribute harus berupa angka"
        ]);

        $foto1 = "";
        $namaFileGambar1  = "";

        $p = new Template();
        $p->id_toko = $user->id_toko;
        $p->nama = $request->nama;
        $p->tipe = $request->tipe;
        $p->harga = $request->harga;
        $p->keterangan = $request->keterangan;




        $namaFolderPhoto = "imgTemplate/";

            // storeAs akan menyimpan default ke local
        if ($request->file('foto') != null) {
            # code...
            $foto1 = $request->file("foto");
            $namaFileGambar1  = Str::random(8).".".$foto1->getClientOriginalExtension();
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar1, 'public');
        }



        $p->gambar = $namaFileGambar1;

        $p->save();
        toast('Berhasil tambah Produk', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect(url('/seller/produkCustom/templateProduk'));

    }

    public function pageEditTemplate($id){
        $user = $this->getLogUser();

        $template = Template::find($id);
        return view("seller.produkCustom.template.editTemplate", ['user'=>$user, 'template'=>$template]);
    }

    public function editTemplate(Request $request, $id){
        $user = $this->getLogUser();

        $request->validate([
            "nama"=>'required',
            "tipe"=>'required',
            "harga"=>'required|integer',
            "keterangan"=>'required',


        ],

        ["required" => ":attribute harus di isi",
        "integer" => ":attribute harus berupa angka"
        ]);

        $foto1 = "";
        $namaFileGambar1  = "";

        $p = Template::find($id);
        $p->id_toko = $user->id_toko;
        $p->nama = $request->nama;
        $p->tipe = $request->tipe;
        $p->harga = $request->harga;
        $p->keterangan = $request->keterangan;

        $namaFolderPhoto = "imgTemplate/";

            // storeAs akan menyimpan default ke local
        if ($request->file('foto') != null) {
            # code...
            $image_path = public_path('storage/imgTemplate/'.$p->gambar);
            if (file_exists($image_path)) {
                # code...
                unlink($image_path);
            }
            $foto1 = $request->file("foto");
            $namaFileGambar1  = Str::random(8).".".$foto1->getClientOriginalExtension();
            $p->gambar = $namaFileGambar1;
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar1, 'public');
        }





        $p->save();
        toast('Berhasil Ubah Template', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect(url('/seller/produkCustom/templateProduk'));

    }

    public function deleteTemplate($id){
        $template = Template::find($id);

        $path1 = public_path('storage/imgTemplate/'.$template->gambar);
        if ($template->gambar != null && file_exists($path1)) {
            # code...
            unlink($path1);
        }

        $template->delete();
        toast('berhasil hapus template', 'success');
        return redirect()->back();
    }


    // END OF TEMPLATE

    // START OF ADD ON

    public function pageAddOn(){
        $user = $this->getLogUser();
        $template = DB::table('add_ons')->where("id_toko",'=',$user->id_toko)->get();
        return view("seller.produkCustom.addon.daftarAddOn", ['user'=>$user, 'listAddOn'=>$template]);

    }

    public function pageTambahAddOn(){
        $user = $this->getLogUser();
        return view("seller.produkCustom.addon.tambahAddOn", ['user'=>$user]);
    }

    public function tambahAddOn(Request $request){
        $user = $this->getLogUser();

        $request->validate([
            "nama"=>'required',
            "tipe"=>'required',
            "harga"=>'required|integer',
            "keterangan"=>'required',
            "foto"=>'required',

        ],

        ["required" => ":attribute harus di isi",
        "integer" => ":attribute harus berupa angka"
        ]);

        $foto1 = "";
        $namaFileGambar1  = "";

        $p = new AddOn();
        $p->id_toko = $user->id_toko;
        $p->nama = $request->nama;
        $p->tipe = $request->tipe;
        $p->harga = $request->harga;
        $p->keterangan = $request->keterangan;




        $namaFolderPhoto = "imgAddOn/";

            // storeAs akan menyimpan default ke local
        if ($request->file('foto') != null) {
            # code...
            $foto1 = $request->file("foto");
            $namaFileGambar1  = Str::random(8).".".$foto1->getClientOriginalExtension();
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar1, 'public');
        }



        $p->gambar = $namaFileGambar1;

        $p->save();
        toast('Berhasil tambah Add-On', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect(url('/seller/produkCustom/addOn'));

    }

    public function pageEditAddOn($id){
        $user = $this->getLogUser();

        $addon = AddOn::find($id);
        return view("seller.produkCustom.addon.editAddOn", ['user'=>$user, 'addon'=>$addon]);
    }

    public function editAddOn(Request $request, $id){
        $user = $this->getLogUser();

        $request->validate([
            "nama"=>'required',
            "tipe"=>'required',
            "harga"=>'required|integer',
            "keterangan"=>'required',


        ],

        ["required" => ":attribute harus di isi",
        "integer" => ":attribute harus berupa angka"
        ]);

        $foto1 = "";
        $namaFileGambar1  = "";

        $p = AddOn::find($id);
        $p->id_toko = $user->id_toko;
        $p->nama = $request->nama;
        $p->tipe = $request->tipe;
        $p->harga = $request->harga;
        $p->keterangan = $request->keterangan;

        $namaFolderPhoto = "imgAddOn/";

            // storeAs akan menyimpan default ke local
        if ($request->file('foto') != null) {
            # code...
            $image_path = public_path('storage/imgAddOn/'.$p->gambar);
            if (file_exists($image_path)) {
                # code...
                unlink($image_path);
            }
            $foto1 = $request->file("foto");
            $namaFileGambar1  = Str::random(8).".".$foto1->getClientOriginalExtension();
            $p->gambar = $namaFileGambar1;
            $foto1->storeAs($namaFolderPhoto,$namaFileGambar1, 'public');
        }





        $p->save();
        toast('Berhasil Edit Add On', 'success');
        // Alert::success('','berhasil tambah satuan');
        return redirect(url('/seller/produkCustom/addOn'));

    }

    public function deleteAddOn($id){
        $addon = AddOn::find($id);

        $path1 = public_path('storage/imgAddOn/'.$addon->gambar);
        if ($addon->gambar != null && file_exists($path1)) {
            # code...
            unlink($path1);
        }

        $addon->delete();
        toast('berhasil hapus add on', 'success');
        return redirect()->back();

    }




    // END OF ADD ON

    // START OF PRODUK CUSTOM


    // halaman tambah produk custom
    public function pageAddCustomProduk(){
        $user = $this->getLogUser();

        $daftarproduk = DB::table('produk_customs')->get();
        return view('seller.produkCustom..produk.tambahProdukCustom', ['user'=>$user, 'listProduk'=>$daftarproduk]);

    }

    public function pageDaftarProdukCustom(){

        $user = $this->getLogUser();

        $daftarproduk = DB::table('produk_custom_dijuals')->where('id_toko','=',$user->id_toko)->get();

        return view('seller.produkCustom.produk.daftarProdukCustom',['user'=>$user,'daftarProduk'=>$daftarproduk]);
    }

    public function pageDetailProdukCustom($id){

        $user = $this->getLogUser();

        $produk = ProdukCustomDijual::find($id);
        $detailKayu = DetailProdukCustomDijual::where('id_produk_custom_dijual', $id)->get();
            $detailAddon = DetailAddonDijual::where('id_produk_custom_dijual', $id)->get();

        if ($produk->nama_template == "Lemari 1") {
            # code...
            

            // Kirim data ke view
            return view('seller.produkCustom.produk.detailLemari1', [
                'user' => $user,
                'detailKayu' => $detailKayu,
                'detailAddon' => $detailAddon
            ]);
        }
        else if($produk->nama_template == "Lemari 2"){

            return view('seller.produkCustom.produk.detailLemari2', [
                'user' => $user,
                'detailKayu' => $detailKayu,
                'detailAddon' => $detailAddon
            ]);
        }
    }


    


    



    // END OF PRODUK CUSTOM


}
