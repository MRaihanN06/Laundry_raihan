<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class GajiController extends Controller
{
    /**
     * Menampilkan view simulasi test4 - gaji karyawan
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Gaji', 'view Gaji');
        return view('Simulasi/test4');
    }
}
