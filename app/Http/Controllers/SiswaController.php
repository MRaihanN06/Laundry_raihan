<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    /**
     * Menampilkan view simulasi test3 - siswa
     *
     */
    public function index()
    {
        return view('Simulasi/test3');
    }
}
