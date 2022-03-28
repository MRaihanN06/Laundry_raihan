<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class TransaksiBarangController extends Controller
{
    /**
     * Menampilkan view simulasi test5 - TransaksiBarang
     *
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Transaksi Barang', 'view Transaksi Barang');
        return view('Simulasi/test5');
    }
}
