<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Menampilkan view index - home
     */
    public function index() {
        return view('index');
    }
}
