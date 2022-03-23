<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GajiController extends Controller
{
    /**
     * Menampilkan view simulasi test4 - gaji karyawan
     */
    public function index()
    {
        return view('Simulasi/test4');
    }
}
