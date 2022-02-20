<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\DetailTransaksiController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('/login');
});

Route::get('/', [AuthController::class, 'showFormLogin'])->name('login');
Route::get('login', [AuthController::class, 'showFormLogin'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showFormRegister'])->name('register')->middleware('auth');
Route::post('register', [AuthController::class, 'register'])->middleware('auth');
Route::get('logout', [AuthController::class, 'logout'])->name('logout'); 

// Route::resource('/outlet', OutletController::class)->middleware('auth');
// Route::resource('/member', MemberController::class)->middleware('auth');
// Route::resource('/paket', PaketController::class)->middleware('auth');
// Route::resource('/user', UserController::class)->middleware('auth');
// Route::resource('/laporan', DetailTransaksiController::class)->middleware('auth');
// Route::resource('/transaksi', TransaksiController::class)->middleware('auth');
// Route::get('index', [HomeController::class, 'index'])->name('home')->middleware('auth');


Route::group(['prefix' => 'a','middleware' => ['isAdmin','auth']], function() {
    Route::get('index', [HomeController::class, 'index'])->name('a.home');
    Route::resource('/member', MemberController::class);
    Route::resource('/paket', PaketController::class);
    Route::resource('/outlet', OutletController::class);
    Route::resource('/user', UserController::class);
    Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::resource('/transaksi', TransaksiController::class);
    Route::get('/laporan', [DetailTransaksiController::class, 'index']);
});

Route::group(['prefix' => 'k','middleware' => ['isKasir','auth']], function() {
    Route::get('index', [HomeController::class, 'index'])->name('k.home');
    Route::resource('/member', MemberController::class);
    Route::resource('/transaksi', TransaksiController::class);
    Route::get('/laporan', [DetailTransaksiController::class, 'index']);
});

Route::group(['prefix' => 'o','middleware' => ['isOwner','auth']], function() {
    Route::get('index', [HomeController::class, 'index'])->name('o.home');
    Route::get('/laporan', [DetailTransaksiController::class, 'index']);
});