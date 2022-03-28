<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class SimulasiTransaksiController extends Controller
{
    /**
     * Menampilkan view simulasi test5 - Transaksi
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Transaksi Cucian', 'view Transaksi Cucian');
        return view('Simulasi/test6');
    }
}
