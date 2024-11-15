<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\GudangController;
use App\Http\Controllers\Lemari1Controller;
use App\Http\Controllers\Lemari2Controller;
use App\Http\Controllers\Lemari3Controller;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\Meja1Controller;
use App\Http\Controllers\Meja2Controller;
use App\Http\Controllers\MembershipController;
use App\Http\Controllers\PesananController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukCustomController;
use App\Http\Controllers\Produksi\BomController;
use App\Http\Controllers\Produksi\HasilProduksiController;
use App\Http\Controllers\produksi\PenggunaanBahanController;
use App\Http\Controllers\Produksi\PerencanaanProduksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TestController;
use App\Models\ProdukCustom;
use App\Models\ProdukCustomDijual;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;
use PgSql\Lob;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/test', function () {
    return view('customer.shopping.dashboard');
});

Route::get('/testshop', function () {
    return view('template.shopTemplate');
});

Route::get('/testshop', function () {
    return view('template.shopTemplate');
});







Route::get('/carimax', [TestController::class, "carimax"]);
Route::get('/coba', [TestController::class, "testmid"]);
Route::get('/bayar/{id}', [TestController::class, "testbayar"])->name('bayarbro');
Route::get('/testcanvas', [TestController::class, "coba"]);

Route::post('donation/pay', [DonationController::class, 'pay'])->name('donation.pay');

// Route::get('/dashboard', function () {
//     // return view('template.homeTemplate');
//     return view('admin.userlog');
// })->middleware(['customUserAuth'])->name("dashboard");

// Route::get('/', [LoginController::class, "formLogin"])->middleware('checkLog')->name('login');

Route::post('/logout', function (Request $request): RedirectResponse {
    Auth::guard('web')->logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    Session::forget('role');
    Session::forget('user');
    return redirect('/');
})->name('logout');

Route::get('/login', [LoginController::class, "formLogin"])->middleware('checkLog')->name('login');
Route::post('/login', [LoginController::class, "loginAction"])->name("loginAct");

Route::get('/register', [LoginController::class, "formRegister"])->middleware('checkLog');
Route::post('/register', [LoginController::class, "registerAction"])->name("register");

// Route::view("/verif","Email.Hverify")->name("verification.notice");
Route::get('verify', [LoginController::class, 'verifyemail'])->name("verification.notice");
Route::post('/cekotp', [LoginController::class, 'cekOtp'])->name('cekotp');
// Route::get('verify', EmailVerificationPromptController::class)->name("verification.notice");
// Route::get("/verify/{id}/{hash}", [LoginController::class, "verification"])->name('verification.verify');

// Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');
Route::get('/toko/membership/check-expired', [MembershipController::class, 'checkExpiredMembership']);
// ADMIN
Route::group([
    'middleware' => ['rememberMe:master'],
    'prefix' => '/masteruser',
], function () {
    Route::get('/', [AdminController::class, "homepage"]);
    Route::get('/produkCustom/tambahProdukCustom', [AdminController::class, 'tambahProdukCustom']);
    Route::get('/produkCustom/daftarProdukCustom', [AdminController::class, 'daftarProdukCustom']);
    Route::get('/produkCustom/templateProduk', [AdminController::class, 'templateProduk']);
    Route::get('/produkCustom/addOn', [AdminController::class, 'listAddOn']);

    Route::post('/tambahTemplate', [AdminController::class, 'tambahTemplate']);


    Route::get('/produkCustom/h1lemari1', [AdminController::class, 'h1lemari1']);
    Route::get('/produkCustom/h2lemari1', [AdminController::class, 'h2lemari1']);
    Route::get('/produkCustom/lemari2', [AdminController::class, 'lemari2']);
    Route::get('/produkCustom/lemari3', [AdminController::class, 'lemari3']);

    Route::get('/produkCustom/meja1', [AdminController::class, 'meja1']);
    Route::get('/produkCustom/lemari3', [AdminController::class, 'lemari3']);
});




//Customer
Route::group([
    // 'middleware' => ['rememberMe:customer', 'customUserAuth'],
    // 'prefix' => '/userc',
], function () {
    Route::get('/', [CustomerController::class, "homePage"]);


    Route::get('/daftarseller', [CustomerController::class, "daftarSeller"])->name('daftarseller');
    Route::get('/becomeSeller', [CustomerController::class, "becomeSeller"])->name('becomeSeller');
    Route::get('/exploreProduk', [CustomerController::class, 'exploreProduk']);

    // detail produk non custom
    Route::get('/d/{id}', [CustomerController::class, "detailProduk"]);

    Route::get('/dc/{id}', [CustomerController::class, 'detailProdukCustom']);


    Route::get('/custom/{id}', [CustomerController::class, 'pageCustom']);
    // Route::get('/customh2/h2lemari1/{id}', [Lemari1Controller::class, 'page2Custom']);
    // Route::post('/save', [CustomerController::class, 'Htrans']);
    // Route::post('/save2',[CustomerController::class, 'finalHTrans']);
});

Route::group([
    'middleware' => ['rememberMe:customer',],
    // 'prefix' => '/userc',
], function () {




    Route::get('/customer/pembelian', [CustomerController::class, "listPembelian"]);
    Route::get('/detailTransaksiCustom/{id}', [CustomerController::class, 'detailTransaksiCustom']);
    Route::get('/detailTransaksiNonCustom/{id}', [CustomerController::class, 'detailTransaksiNonCustom']);

    // Halaman 2 Custom
    Route::get('/customh2/h2lemari1/{id}', [Lemari1Controller::class, 'page2Custom']);
    Route::get('/customh2/h2lemari2/{id}', [Lemari2Controller::class, 'page2Custom']);
    Route::get('/customh2/h2lemari3/{id}', [Lemari3Controller::class, 'page2Custom']);
    Route::get('/customh2/h2meja1/{id}', [Meja1Controller::class, 'page2Custom']);
    Route::get('/customh2/h2meja2/{id}', [Meja2Controller::class, 'page2Custom']);

    Route::post('/save', [CustomerController::class, 'Htrans']);
    Route::post('/save2', [CustomerController::class, 'finalHTrans']);

    Route::post('/halamanCheckout', [CustomerController::class, 'halamanCheckout']);
    Route::post('/checkOutNonCustom', [CustomerController::class, 'checkOutNonCustom']);

    Route::post('/pembayaran', [CustomerController::class, 'pembayaran'])->name('pembayaran');

    Route::post('customer/pembelianSampai/{id}', [CustomerController::class, 'pesananSampai']);
    Route::post('customer/pembelianSelesai/{id}', [CustomerController::class, 'pesananSelesai']);
    Route::post('customer/pengajuanRetur/{id}', [CustomerController::class, 'pengajuanRetur']);

    Route::post('customer/KirimBalik/{id}', [CustomerController::class, 'kirimBalik']);
});


Route::group([
    'middleware' => ['rememberMe:customer', 'checkStatusUser', 'customUserAuth'],
    'prefix' => '/seller',
], function () {
    Route::get('/', [SellerController::class, "homePage"]);
    Route::get('/test1', [SellerController::class, "homePage2"]);

    Route::get('/membership', [MembershipController::class, 'membershipPage']);
    Route::post('/beliMembership', [MembershipController::class, 'checkoutPage']);
    Route::post('/checkout', [MembershipController::class, 'checkout'])->name('checkout');

    Route::get('/pegawai', [SellerController::class, 'pegawaiPage']);
    Route::post('/addPegawai', [SellerController::class, 'addPegawai']);
    Route::post('/editPegawai/{id}', [SellerController::class, 'editPegawai']);
    Route::get('/deletePegawai/{id}', [SellerController::class, 'deletePegawai']);
    //START OF TOKO
    //PRODUK
    Route::get('/produk/daftarProduk', [ProdukController::class, 'pageDaftarProduk']);
    Route::get('/produk/tambahProduk', [ProdukController::class, 'pageAddProduk']);
    Route::post('/addProduk', [ProdukController::class, 'addProduk']);
    Route::post('/ubahStatusProduk', [ProdukController::class, 'ubahStatusProduk'])->name('ubahStatusProduk');
    Route::get('/pEditProduk/{id}', [ProdukController::class, 'pageEditProduk']);
    Route::post('editProduk/{id}', [ProdukController::class, 'editProduk']);
    Route::get('deleteProduk/{id}', [ProdukController::class, 'deleteProduk']);

    //START OF PRODUK CUSTOM
    // PRODUK CUSTOM

    Route::get('/produkCustom/tambahProdukCustom', [ProdukCustomController::class, 'pageAddCustomProduk']);
    Route::get('/produkCustom/daftarProdukCustom', [ProdukCustomController::class, 'pageDaftarProdukCustom']);
    Route::get('/produkCustom/detailProdukCustom/{id}', [ProdukCustomController::class, 'pageDetailProdukCustom']);
    // Route::post('/addProdukCustom',[ProdukCustomController::class, 'addCustomProduk']);
    Route::post('/ubahStatusProdukCustom', [ProdukCustomController::class, 'ubahStatusProduk'])->name('ubahStatusProdukCustom');
    // ini untuk ubah nama, ukuran minimal maksimal dan deskripsi
    Route::post('/produkCustom/editDetailProduk', [ProdukCustomController::class, 'editDetailProduk']);

    Route::get('/produkCustom/delete/{id}', [ProdukCustomController::class, 'deleteProdukCustom']);
    // TAMBAH PRODUK CUSTOM
    Route::get('/produkCustom/tambahLemari1', [Lemari1Controller::class, 'tambahLemari1']);
    Route::post('/produkCustom/ubahDetailLemari1', [Lemari1Controller::class, 'ubahDetailLemari1']);

    Route::get('/produkCustom/tambahLemari2', [Lemari2Controller::class, 'tambahLemari2']);
    Route::post('/produkCustom/ubahDetailLemari2', [Lemari2Controller::class, 'ubahDetailLemari2']);

    Route::get('/produkCustom/tambahLemari3', [Lemari3Controller::class, 'tambahLemari3']);
    Route::post('/produkCustom/ubahDetailLemari3', [Lemari3Controller::class, 'ubahDetailLemari3']);


    Route::get('/produkCustom/tambahMeja1', [Meja1Controller::class, 'tambahMeja1']);
    Route::post('/produkCustom/ubahDetailMeja1', [Meja1Controller::class, 'ubahDetailMeja1']);

    Route::get('/produkCustom/tambahMeja2', [Meja2Controller::class,'tambahMeja2']);
    Route::post('/produkCustom/ubahDetailMeja2', [Meja2Controller::class,'ubahDetailMeja2']);

    // END OF TAMBAH PRODUK CUSTOM

    // Master Finishing

    Route::get('/produkCustom/daftarFinishing', [ProdukCustomController::class, 'daftarFinishing']);
    Route::post('/produkCustom/addFinishing', [ProdukCustomController::class, 'addFinishing']);
    Route::post('/produkCustom/editFinishing/{id}', [ProdukCustomController::class, 'editFinishing']);
    Route::get('/produkCustom/deleteFinishing/{id}', [ProdukCustomController::class, 'deleteFinishing']);

    // Finishig Produk
    Route::get('produkCustom/daftarFinishingDijual/{id}',[ProdukCustomController::class, 'daftarFinishingDijual']);
    Route::post('/produkCustom/addFinishingDijual/{id}', [ProdukCustomController::class, 'addFinishingDijual']);
    Route::post('/produkCustom/editFinishingDijual/{id}', [ProdukCustomController::class, 'editFinishingDijual']);
    Route::get('/produkCustom/deleteFinishingDijual/{id}', [ProdukCustomController::class, 'deleteFinishingDijual']);

    // END OF PRODUK CUSTOM

    //TESTING PRODUK CUSTOM
    // LEMARI 1
    Route::get('/produkCustom/testing/lemari1', [Lemari1Controller::class, 'testing']);
    Route::get('/produkCustom/testing/h2lemari1', [Lemari1Controller::class, 'testing2']);

    //LEMARI 2
    Route::get('/produkCustom/testing/lemari2', [Lemari2Controller::class, 'testing']);
    Route::get('/produkCustom/testing/h2lemari2', [Lemari2Controller::class, 'testing2']);

    //LEMARI 3
    Route::get('/produkCustom/testing/lemari3', [Lemari3Controller::class, 'testing']);
    Route::get('/produkCustom/testing/h2lemari3', [Lemari3Controller::class, 'testing2']);

    // Meja 1
    Route::get('/produkCustom/testing/meja1', [Meja1Controller::class, 'testing']);
    Route::get('/produkCustom/testing/h2meja1', [Meja1Controller::class, 'testing2']);

    // Meja 2
    Route::get('/produkCustom/testing/meja2', [Meja2Controller::class, 'testing']);
    Route::get('/produkCustom/testing/h2meja2', [Meja2Controller::class, 'testing2']);


    // END TESTING PRODUK CUSTOM


    // PESANAN

    Route::get('/pesanan', [PesananController::class, 'pagePesanan']);
    // List Pesanan
    Route::get('/pesanan/nonCustom', [PesananController::class, 'pagePesananNonCustom']);
    Route::get('/pesanan/custom', [PesananController::class, 'pagePesananCustom']);
    Route::get('/pesanan/produksi', [PesananController::class, 'pagePesananProduksi']);
    Route::get('/pesanan/siapDikirim', [PesananController::class, 'pagePesananSiapDikirim']);
    Route::get('/pesanan/dalamPengiriman', [PesananController::class, 'pagePesananDalamPengiriman']);
    Route::get('/pesanan/selesai', [PesananController::class, 'pagePesananSelesai']);
    Route::get('/pesanan/batal', [PesananController::class, 'pagePesananBatal']);

    Route::get('/detailPesanan/{id}', [PesananController::class, 'detailPesanan']);
    Route::get('/custom/redesain/{id}', [PesananController::class, "redesain"]);
    Route::post('/kirimRedesain', [PesananController::class, 'kirimRedesain']);
    Route::post('/custom/terimaPesanan', [PesananController::class, 'terimaPesananCustom']);
    Route::post('/nonCustom/terimaPesanan', [PesananController::class, 'terimaPesananNonCustom']);

    // TOLAK PESANAN
    Route::post('/pesanan/batalkan/{id}', [PesananController::class, 'tolakPesanan']);

    // Kirim Pesanan
    Route::post('/pesanan/kirim/{id}', [PesananController::class, 'kirimPesanan']);
    Route::post('/pesanan/ubahResi/{id}', [PesananController::class, 'ubahResi']);

    //RETUR
    Route::post('/pesanan/terimaRetur/{id}', [PesananController::class, 'terimaRetur']);
    Route::post('/pesanan/tolakRetur/{id}', [PesananController::class, 'tolakRetur']);

    // TESTING APA AJAH
    Route::get('/produkCustom/testing', [TestController::class, 'testingfabric']);
    Route::get('/produkCustom/TestingMeja1', [TestController::class, 'testingMeja1']);

    Route::post('/save-image', [TestController::class, 'uploadImage'])->name('save.image');

    // //TEMPLATE
    // Route::get('/produkCustom/templateProduk', [ProdukCustomController::class, 'pageTemplateProduk']);
    // Route::get('/produkCustom/tambahTemplate', [ProdukCustomController::class, 'pageTambahTemplate']);
    // Route::post('/addTemplate', [ProdukCustomController::class, 'addTemplate']);
    // Route::get('/pEditTemplate/{id}', [ProdukCustomController::class, 'pageEditTemplate']);
    // Route::post('/editTemplate/{id}', [ProdukCustomController::class, 'editTemplate']);
    // Route::get('/deleteTemplate/{id}', [ProdukCustomController::class, 'deleteTemplate']);

    // // ADD ON

    // Route::get("/produkCustom/addOn", [ProdukCustomController::class, 'pageAddOn']);
    // Route::get("/produkCustom/tambahAddOn", [ProdukCustomController::class, 'pageTambahAddOn']);
    // Route::post("/addAddOn", [ProdukCustomController::class, 'tambahAddOn']);
    // Route::get("pEditAddOn/{id}", [ProdukCustomController::class, "pageEditAddOn"]);
    // Route::post("editAddOn/{id}", [ProdukCustomController::class, "editAddOn"]);
    // Route::get("/deleteAddOn/{id}", [ProdukCustomController::class, "deleteAddOn"]);

    //Satuan
    Route::get('/Satuan', [MasterController::class, "pageMasterSatuan"]);
    Route::post('/addSatuan', [MasterController::class, "addSatuan"])->name('addSatuan');
    Route::get('/deleteSatuan/{id}', [MasterController::class, "deleteSatuan"]);
    Route::post('/editSatuan/{id}', [MasterController::class, "editSatuan"]);

    // PERMINTAAN PEMBELIAN
    Route::get('/permintaanPembelian', [GudangController::class, 'riwayatPermintaanPembelian']);
    Route::get('/formPermintaanPembelian', [GudangController::class, 'formPermintaanPembelian']);
    Route::post('/buatPermintaanPembelian', [GudangController::class, 'buatPermintaanPembelian']);
    Route::post('/pencatatanPembelian/hapus/{id}', [GudangController::class, 'hapusPembelian']);

    //==================================================================================================================================
    // FITUR PRO ONLY
    Route::group([
        'middleware' => ['proOnly'],
    ], function () {
        //START OF Master

        // SUPPLIER
        Route::get('/master/supplier', [MasterController::class, "pageMasterSupplier"]);
        Route::get('/pAddSupplier', [MasterController::class, "pageAddSupplier"]);
        Route::post('/addSupplier', [MasterController::class, "addSupplier"]);
        Route::get('/deleteSupplier/{id}', [MasterController::class, "deleteSupplier"]);
        Route::get('/pEditSupplier/{id}', [MasterController::class, "pageEditSupplier"]);
        Route::post('/editSupplier/{id}', [MasterController::class, "editSupplier"]);

        // BAHAN
        Route::get('/master/bahan', [MasterController::class, "pageMasterBahan"]);
        Route::get('/pAddBahan', [MasterController::class, "pageAddBahan"]);
        Route::post('/addBahan', [MasterController::class, "addBahan"]);
        Route::get('/deleteBahan/{id}', [MasterController::class, "deleteBahan"]);
        Route::get('/pEditBahan/{id}', [MasterController::class, "pageEditBahan"]);
        Route::post('/editBahan/{id}', [MasterController::class, "editBahan"]);

        //Mebel
        Route::get('/master/mebel', [MasterController::class, "pageMasterMebel"]);
        Route::get('/pAddMebel', [MasterController::class, "pageAddMebel"]);
        Route::post('/addMebel', [MasterController::class, "addMebel"]);
        Route::get('/deleteMebel/{id}', [MasterController::class, "deleteMebel"]);
        Route::get('/pEditMebel/{id}', [MasterController::class, "pageEditMebel"]);
        Route::post('/editMebel/{id}', [MasterController::class, "editMebel"]);

        // END OF MASTER

        // START OF PRODUKSI


        //Perencanaan Produksi
        Route::get('/produksi/perencanaanProduksi', [PerencanaanProduksiController::class, "pagePerencanaanProduksi"]);
        Route::get('/pAddProduksi', [PerencanaanProduksiController::class, 'pageAddProduksi']);
        Route::post('/addProduksi', [PerencanaanProduksiController::class, 'addProduksi']);
        Route::get('/pEditProduksi/{id}', [PerencanaanProduksiController::class, 'pageEditProduksi']);
        Route::post('/editProduksi/{id}', [PerencanaanProduksiController::class, 'editProduksi']);
        Route::get('/batalkanProduksi/{id}', [PerencanaanProduksiController::class, 'batalkanProduksi']);
        Route::get('/getBom', [PerencanaanProduksiController::class, 'getBom']);
        Route::get('/pDetailProduksi/{id}', [PerencanaanProduksiController::class, 'pageDetailProduksi']);
        Route::get('/pRiwayatProduksi', [PerencanaanProduksiController::class, 'pageRiwayatProduksi']);
        Route::get('/penyelesaianProduksi/{id}', [PerencanaanProduksiController::class, 'pagePenyelesaianProduksi']);
        Route::post('/simpanHasilProduksi', [PerencanaanProduksiController::class, 'simpanHasilProduksi']);
        Route::get('/detailRiwayatProduksi/{id}', [PerencanaanProduksiController::class, 'detailRiwayatProduksi']);


        //BILL OF MATERIAL
        Route::get('/produksi/bom', [BomController::class, "pageBOM"]);
        Route::get('/pAddBom', [BomController::class, "pageAddBom"]);
        Route::post('/addBom', [BomController::class, "addBom"]);
        Route::get('/deleteBom/{id}', [BomController::class, "deleteBom"]);
        Route::get('/pEditBom/{id}', [BomController::class, "pageEditBom"]);
        Route::post('/editBom/{id}', [BomController::class, "editBom"]);

        // detail bom
        Route::get('/pDetailBom/{id}', [BomController::class, "pageDetailBom"]);
        Route::post('/addDetailBom/{id}', [BomController::class, "addDetailBom"]);
        Route::get('/pAddDetailBom/{id}', [BomController::class, "pageAddDetailBom"]);
        Route::get('/pEditDetailBom/{id}', [BomController::class, "pageEditDetailBom"]);
        Route::post('/editDetailBom/{id}', [BomController::class, "editDetailBom"]);
        Route::get('/deleteDetailBom/{id}', [BomController::class, "deleteDetailBom"]);
        Route::get('/tambahDetailBom/getBahan', [BomController::class, "getBahan"]);

        // END OF PRODUKSI


        // START OF GUDANG

        Route::get('/gudang/riwayatMutasi', [GudangController::class, 'pageMutasi']);
        Route::get('/api/get-stok-mebel/{id}', [GudangController::class, 'getStokMebel']);

        // Route untuk mendapatkan stok bahan
        Route::get('/api/get-stok-bahan/{id}', [GudangController::class, 'getStokBahan']);
        Route::post('/gudang/inputMutasi', [GudangController::class, 'storeMutasiMebel']);



        // END OF GUDANG

    });










    // INPUT HASIL PRODUKSI
    // Route::get('/inputHasilProduksi', [HasilProduksiController::class, "pageInputHasilProduksi"]);
    // Route::get('/getRP', [HasilProduksiController::class, "getRencanaProduksi"]);
    // Route::post('/simpanHasilProduksi',[HasilProduksiController::class, 'addHasilProduksi']);
    // Route::get('/riwayatInputHasilProduksi',[HasilProduksiController::class, 'riwayatInputHasilProduksi']);


    //PENGGUNAAN BAHAN
    Route::get('/produksi/tambahPenggunaanBahan', [PenggunaanBahanController::class, 'pageAddPenggunaanBahan']);


    // END OF PRODUKSI
});


// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });
