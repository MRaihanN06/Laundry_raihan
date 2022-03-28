<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller

{
    /**
     * Menampilkan view index - home
     */
    public function index() {
        Logging::record(Auth::user(), 'Akses view Dasboard', 'view Dasboard');
        return view('index');
    }
}
