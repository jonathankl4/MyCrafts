<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
use App\Http\Controllers\Produksi\BomController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SellerController;
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

Route::get('/testcanvas', function () {
    return view('customer.test');
});


// Route::get('/coba', [BomController::class, "pageBOM"]);

// Route::get('/dashboard', function () {
//     // return view('template.homeTemplate');
//     return view('admin.userlog');
// })->middleware(['customUserAuth'])->name("dashboard");

Route::get('/', [LoginController::class, "formLogin"])->middleware('checkLog')->name('login');

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
    'middleware' => ['rememberMe:admin', 'customUserAuth'],
    'prefix' => '/admin',
],function () {
    Route::get('/',[AdminController::class, "homepage"]);
});


//Customer
Route::group([
    'middleware' => ['rememberMe:customer', 'customUserAuth'],
    'prefix' => '/userc',
],function () {
    Route::get('/',[CustomerController::class, "homePage"]);
    Route::get('/daftarseller',[CustomerController::class, "daftarSeller"])->name('daftarseller');
    Route::get('/becomeSeller', [CustomerController::class, "becomeSeller"])->name('becomeSeller');
});


Route::group([
    'middleware' => ['rememberMe:customer', 'checkStatusUser', 'customUserAuth'],
    'prefix' => '/seller',
],function () {
    Route::get('/',[SellerController::class, "homePage"]);
    Route::get('/test1',[SellerController::class, "homePage2"]);

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

    //BILL OF MATERIAL
    Route::get('/produksi/bom', [BomController::class, "pageBOM"]);
    Route::get('/pAddBom', [BomController::class, "pageAddBom"]);
    Route::post('/addBom', [BomController::class, "addBom"]);
    Route::get('/deleteBom/{id}', [BomController::class, "deleteBom"]);
    Route::get('/pEditBom/{id}',[BomController::class, "pageEditBom"]);
    Route::post('/editBom/{id}', [BomController::class, "editBom"]);



    Route::get('/pDetailBom/{id}', [BomController::class, "pageDetailBom"]);
    Route::post('/addDetailBom/{id}', [BomController::class, "addDetailBom"]);
    Route::get('/pAddDetailBom/{id}', [BomController::class, "pageAddDetailBom"]);
    Route::get('/pEditDetailBom/{id}',[BomController::class, "pageEditDetailBom"]);
    Route::post('/editDetailBom/{id}',[BomController::class, "editDetailBom"]);
    Route::get('/deleteDetailBom/{id}',[BomController::class, "deleteDetailBom"]);





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


