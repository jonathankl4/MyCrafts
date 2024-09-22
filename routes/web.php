<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\ProdukCustomController;
use App\Http\Controllers\Produksi\BomController;
use App\Http\Controllers\Produksi\HasilProduksiController;
use App\Http\Controllers\produksi\PenggunaanBahanController;
use App\Http\Controllers\Produksi\PerencanaanProduksiController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
use App\Http\Controllers\TestController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

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
Route::get('/bayar', [TestController::class, "testbayar"])->name('bayarbro');
Route::get('/testcanvas',[TestController::class, "coba"]);

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

Route::get('/register', [LoginController::class,"formRegister"])->middleware('checkLog');
Route::post('/register',[LoginController::class, "registerAction"])->name("register");

// Route::view("/verif","Email.Hverify")->name("verification.notice");
Route::get('verify', EmailVerificationPromptController::class)->name("verification.notice");
Route::get("/verify/{id}/{hash}", [LoginController::class, "verification"])->name('verification.verify');

Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])->middleware('throttle:6,1')->name('verification.send');

// ADMIN
Route::group([
    'middleware' => ['rememberMe:master'],
    'prefix' => '/masteruser',
],function () {
    Route::get('/',[AdminController::class, "homepage"]);
    Route::get('/produkCustom/tambahProdukCustom',[AdminController::class,'tambahProdukCustom']);
    Route::get('/produkCustom/daftarProdukCustom',[AdminController::class,'daftarProdukCustom']);
    Route::get('/produkCustom/templateProduk',[AdminController::class, 'templateProduk']);
    Route::get('/produkCustom/addOn',[AdminController::class,'listAddOn']);

    Route::post('/tambahTemplate',[AdminController::class,'tambahTemplate']);


    Route::get('/produkCustom/lemari1',[AdminController::class, 'lemari1']);
    Route::get('/produkCustom/lemari2',[AdminController::class, 'lemari2']);
    Route::get('/produkCustom/lemari3',[AdminController::class, 'lemari3']);

    

});




//Customer
Route::group([
    // 'middleware' => ['rememberMe:customer', 'customUserAuth'],
    // 'prefix' => '/userc',
],function () {
    Route::get('/',[CustomerController::class, "homePage"]);


    Route::get('/daftarseller',[CustomerController::class, "daftarSeller"])->name('daftarseller');
    Route::get('/becomeSeller', [CustomerController::class, "becomeSeller"])->name('becomeSeller');

    Route::get('/d/{id}',[CustomerController::class, "detailProduk"]);
});


Route::group([
    'middleware' => ['rememberMe:customer', 'checkStatusUser', 'customUserAuth'],
    'prefix' => '/seller',
],function () {
    Route::get('/',[SellerController::class, "homePage"]);
    Route::get('/test1',[SellerController::class, "homePage2"]);

    //START OF TOKO
    //PRODUK
    Route::get('/produk/daftarProduk', [ProdukController::class, 'pageDaftarProduk']);
    Route::get('/produk/tambahProduk', [ProdukController::class, 'pageAddProduk']);
    Route::post('/addProduk',[ProdukController::class, 'addProduk']);
    Route::post('/ubahStatusProduk', [ProdukController::class, 'ubahStatusProduk'])->name('ubahStatusProduk');
    Route::get('/pEditProduk/{id}', [ProdukController::class, 'pageEditProduk']);
    Route::post('editProduk/{id}', [ProdukController::class, 'editProduk']);
    Route::get('deleteProduk/{id}',[ProdukController::class, 'deleteProduk']);

    //START OF PRODUK CUSTOM
    // PRODUK CUSTOM
    
    Route::get('/produkCustom/tambahProdukCustom',[ProdukCustomController::class, 'pageAddCustomProduk']);
    Route::get('/produkCustom/tambahProdukCustom',[ProdukCustomController::class, 'pageAddCustomProduk']);
    Route::post('/addProdukCustom',[ProdukCustomController::class, 'addCustomProduk']);

    //TESTING PRODUK CUSTOM
    Route::get('/produkCustom/testing', [TestController::class, 'testingfabric']);
    Route::post('/save-image',[TestController::class, 'uploadImage'])->name('save.image');

    //TEMPLATE
    Route::get('/produkCustom/templateProduk', [ProdukCustomController::class, 'pageTemplateProduk']);
    Route::get('/produkCustom/tambahTemplate', [ProdukCustomController::class, 'pageTambahTemplate']);
    Route::post('/addTemplate', [ProdukCustomController::class, 'addTemplate']);
    Route::get('/pEditTemplate/{id}',[ProdukCustomController::class, 'pageEditTemplate']);
    Route::post('/editTemplate/{id}', [ProdukCustomController::class, 'editTemplate']);
    Route::get('/deleteTemplate/{id}', [ProdukCustomController::class, 'deleteTemplate']);

    // ADD ON

    Route::get("/produkCustom/addOn", [ProdukCustomController::class, 'pageAddOn']);
    Route::get("/produkCustom/tambahAddOn", [ProdukCustomController::class, 'pageTambahAddOn']);
    Route::post("/addAddOn", [ProdukCustomController::class, 'tambahAddOn']);
    Route::get("pEditAddOn/{id}", [ProdukCustomController::class, "pageEditAddOn"]);
    Route::post("editAddOn/{id}", [ProdukCustomController::class, "editAddOn"]);
    Route::get("/deleteAddOn/{id}", [ProdukCustomController::class, "deleteAddOn"]);



    //START OF Master
    //Satuan
    Route::get('/master/Satuan',[MasterController::class, "pageMasterSatuan"]);
    Route::post('/addSatuan',[MasterController::class, "addSatuan"])->name('addSatuan');
    Route::get('/deleteSatuan/{id}', [MasterController::class, "deleteSatuan"]);
    Route::post('/editSatuan/{id}', [MasterController::class, "editSatuan"]);

    //Supplier
    Route::get('/master/supplier', [MasterController::class, "pageMasterSupplier"]);
    Route::get('/pAddSupplier', [MasterController::class, "pageAddSupplier"]);
    Route::post('/addSupplier', [MasterController::class, "addSupplier"]);
    Route::get('/deleteSupplier/{id}', [MasterController::class, "deleteSupplier"]);
    Route::get('/pEditSupplier/{id}', [MasterController::class, "pageEditSupplier"]);
    Route::post('/editSupplier/{id}', [MasterController::class, "editSupplier"]);

    //Bahan
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
    Route::get('/produksi/perencanaanProduksi',[PerencanaanProduksiController::class, "pagePerencanaanProduksi"]);
    Route::get('/pAddProduksi',[PerencanaanProduksiController::class, 'pageAddProduksi']);
    Route::post('/addProduksi',[PerencanaanProduksiController::class, 'addProduksi']);
    Route::get('/pEditProduksi/{id}',[PerencanaanProduksiController::class, 'pageEditProduksi']);
    Route::post('/editProduksi/{id}',[PerencanaanProduksiController::class, 'editProduksi']);
    Route::get('/batalkanProduksi/{id}',[PerencanaanProduksiController::class, 'batalkanProduksi']);
    Route::get('/getBom',[PerencanaanProduksiController::class, 'getBom']);
    Route::get('/pDetailProduksi/{id}',[PerencanaanProduksiController::class, 'pageDetailProduksi']);
    Route::get('/pRiwayatProduksi',[PerencanaanProduksiController::class, 'pageRiwayatProduksi']);
    Route::get('/penyelesaianProduksi/{id}',[PerencanaanProduksiController::class,'pagePenyelesaianProduksi']);
    Route::post('/simpanHasilProduksi',[PerencanaanProduksiController::class, 'simpanHasilProduksi']);
    Route::get('/detailRiwayatProduksi/{id}',[PerencanaanProduksiController::class,'detailRiwayatProduksi']);


    //BILL OF MATERIAL
    Route::get('/produksi/bom', [BomController::class, "pageBOM"]);
    Route::get('/pAddBom', [BomController::class, "pageAddBom"]);
    Route::post('/addBom', [BomController::class, "addBom"]);
    Route::get('/deleteBom/{id}', [BomController::class, "deleteBom"]);
    Route::get('/pEditBom/{id}',[BomController::class, "pageEditBom"]);
    Route::post('/editBom/{id}', [BomController::class, "editBom"]);

    // detail bom
    Route::get('/pDetailBom/{id}', [BomController::class, "pageDetailBom"]);
    Route::post('/addDetailBom/{id}', [BomController::class, "addDetailBom"]);
    Route::get('/pAddDetailBom/{id}', [BomController::class, "pageAddDetailBom"]);
    Route::get('/pEditDetailBom/{id}',[BomController::class, "pageEditDetailBom"]);
    Route::post('/editDetailBom/{id}',[BomController::class, "editDetailBom"]);
    Route::get('/deleteDetailBom/{id}',[BomController::class, "deleteDetailBom"]);
    Route::get('/tambahDetailBom/getBahan',[BomController::class, "getBahan"]);


    // INPUT HASIL PRODUKSI
    // Route::get('/inputHasilProduksi', [HasilProduksiController::class, "pageInputHasilProduksi"]);
    // Route::get('/getRP', [HasilProduksiController::class, "getRencanaProduksi"]);
    // Route::post('/simpanHasilProduksi',[HasilProduksiController::class, 'addHasilProduksi']);
    // Route::get('/riwayatInputHasilProduksi',[HasilProduksiController::class, 'riwayatInputHasilProduksi']);


    //PENGGUNAAN BAHAN
    Route::get('/produksi/tambahPenggunaanBahan',[PenggunaanBahanController::class, 'pageAddPenggunaanBahan']);


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


