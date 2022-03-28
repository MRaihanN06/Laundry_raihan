<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class SiswaController extends Controller
{
    /**
     * Menampilkan view simulasi test3 - siswa
     *
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Siswa', 'view Siswa');
        return view('Simulasi/test3');
    }
}
