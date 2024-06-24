<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MasterController;
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

// Route::get('/', function () {
//     return view('login');
// });


Route::get('/coba', [AdminController::class, "homepage"]);

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

});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

// require __DIR__.'/auth.php';
