<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SimulasiController extends Controller
{
    /**
     * Menampilkan view simulasi test2 - databuku
     *
     */
    public function index()
    {
        return view('Simulasi/test2');
    }
}
