<?php

namespace App\Http\Controllers;

use App\Models\logging;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;

class LoggingController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Logging', 'view Logging');
        $data['user'] = user::get();
        $data['logging'] = logging::get();
        return view('logging/index', $data);
    }
}
