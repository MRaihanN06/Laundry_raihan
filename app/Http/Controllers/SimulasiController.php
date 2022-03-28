<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class SimulasiController extends Controller
{
    /**
     * Menampilkan view simulasi test2 - databuku
     *
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Simulai', 'view Simulasi');
        return view('Simulasi/test2');
    }
}
