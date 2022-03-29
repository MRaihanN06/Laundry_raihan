<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OutletController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\PBarangController;
use App\Http\Controllers\PeBarangController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SimulasiController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\GajiController;
use App\Http\Controllers\SimulasiTransaksiController;
use App\Http\Controllers\TransaksiBarangController;
use App\Http\Controllers\penjemputanController;
use App\Http\Controllers\LoggingController;


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
Route::get('export/paket', [PaketController::class, 'exportData'])->name('export-paket');
Route::post('import/paket', [PaketController::class, 'importData'])->name('import-paket');
Route::get('paket/pdf', [PaketController::class, 'exportPDF'])->name('importpdf-paket');
Route::get('export/barang', [BarangController::class, 'exportData'])->name('export-barang');
Route::post('import/barang', [BarangController::class, 'importData'])->name('import-barang');
Route::get('barang/pdf', [BarangController::class, 'exportPDF'])->name('importpdf-barang');
Route::get('export/outlet', [OutletController::class, 'exportData'])->name('export-outlet');
Route::post('import/outlet', [OutletController::class, 'importData'])->name('import-outlet');
Route::get('outlet/pdf', [OutletController::class, 'exportPDF'])->name('importpdf-outlet');
Route::get('export/member', [MemberController::class, 'exportData'])->name('export-member');
Route::post('import/member', [MemberController::class, 'importData'])->name('import-member');
Route::get('member/pdf', [MemberController::class, 'exportPDF'])->name('importpdf-member');
Route::get('export/penjemputan', [penjemputanController::class, 'exportData'])->name('export-penjemputan');
Route::post('import/penjemputan', [penjemputanController::class, 'importData'])->name('import-penjemputan');
Route::get('penjemputan/pdf', [penjemputanController::class, 'exportPDF'])->name('exportpdf-penjemputan');
Route::get('export/pbarang', [PBarangController::class, 'exportData'])->name('export-pbarang');
Route::post('import/pbarang', [PBarangController::class, 'importData'])->name('import-pbarang');
Route::get('pbarang/pdf', [PBarangController::class, 'exportPDF'])->name('exportpdf-pbarang');
Route::get('export/pebarang', [PeBarangController::class, 'exportData'])->name('export-pebarang');
Route::post('import/pebarang', [PeBarangController::class, 'importData'])->name('import-pebarang');
Route::get('pebarang/pdf', [PeBarangController::class, 'exportPDF'])->name('exportpdf-pebarang');
Route::get('export/user', [UserController::class, 'exportData'])->name('export-user');
Route::get('user/pdf', [UserController::class, 'exportPDF'])->name('exportpdf-user');
Route::get('/transaksi/faktur/{id}', [TransaksiController::class, 'fakturPDF'])->name('faktur');
Route::get('/laporan/pdf', [TransaksiController::class, 'laporanPDF'])->name('laporanPDF');
Route::get('export/laporan', [TransaksiController::class, 'exportData'])->name('export-laporan');
Route::get('/laporanbelum/pdf', [TransaksiController::class, 'laporanbelumPDF'])->name('laporanbelumPDF');
Route::get('export/laporanbelum', [TransaksiController::class, 'exportbelumData'])->name('export-laporanbelum');


Route::group(['prefix' => 'a', 'middleware' => ['isAdmin', 'auth']], function () {
    Route::get('index', [HomeController::class, 'index'])->name('a.home');
    Route::resource('/member', MemberController::class);
    Route::resource('/paket', PaketController::class);
    Route::resource('/outlet', OutletController::class);
    Route::resource('/user', UserController::class);
    Route::resource('/barang', BarangController::class);
    Route::post('/bstatus', [PBarangController::class ,'bstatus'])->name('bstatus');
    Route::resource('/pbarang', PBarangController::class);
    Route::post('/pestatus', [PeBarangController::class ,'pestatus'])->name('pestatus');
    Route::resource('/pebarang', PeBarangController::class);
    Route::get('register', [AuthController::class, 'showFormRegister'])->name('register');
    Route::post('register', [AuthController::class, 'register']);
    Route::resource('/transaksi', TransaksiController::class);
    Route::get('/laporan', [TransaksiController::class, 'laporan']);
    Route::get('/laporanbelum', [TransaksiController::class, 'laporanbelum']);
    Route::get('data_karyawan', [SimulasiController::class, 'index']);
    Route::get('data_siswa', [SiswaController::class, 'index']);
    Route::get('GajiKaryawan', [GajiController::class, 'index']);
    Route::get('TransaksiBarang', [TransaksiBarangController::class, 'index']);
    Route::get('SimulasiTransaksi', [SimulasiTransaksiController::class, 'index']);
    Route::get('logging', [LoggingController::class, 'index']);
    Route::resource('/penjemputan', penjemputanController::class);
    Route::post('/status', [penjemputanController::class ,'status'])->name('status');
});

Route::group(['prefix' => 'k', 'middleware' => ['isKasir', 'auth']], function () {
    Route::get('index', [HomeController::class, 'index'])->name('k.home');
    Route::resource('/member', MemberController::class);
    Route::resource('/transaksi', TransaksiController::class);
    Route::get('/laporan', [TransaksiController::class, 'index']);
});

Route::group(['prefix' => 'o', 'middleware' => ['isOwner', 'auth']], function () {
    Route::get('index', [HomeController::class, 'index'])->name('o.home');
    Route::get('/laporan', [TransaksiController::class, 'index']);
});
