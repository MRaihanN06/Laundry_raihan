<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\outlet;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use App\Models\logging;


class AuthController extends Controller
{
    public function showFormLogin()
    {
        Logging::record(Auth::user(), 'Akses view Login', 'view Login');
        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            return redirect()->route('login');
        }
        return view('/login');
    }

    public function login(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Login Validate', 'Login Validate');
        $rules = [
            'email'                 => 'required|email',
            'password'              => 'required|string'
        ];

        $messages = [
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'password.required'     => 'Password wajib diisi',
            'password.string'       => 'Password harus berupa string'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        Auth::attempt($data);

        if (Auth::check()) { // true sekalian session field di users nanti bisa dipanggil via Auth
            //Login Success
            if (auth::user()->role == 'admin') {
                return redirect()->route('a.home');
            } else if (auth::user()->role == 'kasir') {
                return redirect()->route('k.home');
            } else if (auth::user()->role == 'owner') {
                return redirect()->route('o.home');
            }
            return redirect()->route('home');
        } else { // false

            //Login Fail
            Session::flash('error', 'Email atau password salah');
            return redirect()->route('login');
        }
    }

    public function showFormRegister()
    {
        Logging::record(Auth::user(), 'Akses view Register', 'view Register');
        $data['outlet'] = outlet::get();
        return view('register', $data);
    }

    public function register(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Register Validate', 'Register Validate');
        $rules = [
            'name'                  => 'required|min:3|max:35',
            'email'                 => 'required|email|unique:users,email',
            'password'              => 'required|confirmed',
            'id_outlet'             => 'required',
            'role'                  => 'required',

        ];

        $messages = [
            'name.required'         => 'Nama Lengkap wajib diisi',
            'name.min'              => 'Nama lengkap minimal 3 karakter',
            'name.max'              => 'Nama lengkap maksimal 35 karakter',
            'email.required'        => 'Email wajib diisi',
            'email.email'           => 'Email tidak valid',
            'email.unique'          => 'Email sudah terdaftar',
            'password.required'     => 'Password wajib diisi',
            'password.confirmed'    => 'Password tidak sama dengan konfirmasi password',
            'id_outlet.required'    => 'Id oulet wajib diisi',
            'role.required'         => 'Role wajib diisi'
        ];

        $validator = Validator::make($request->all(), $rules, $messages);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput($request->all);
        }

        $user = new User;
        $user->name = ucwords(strtolower($request->name));
        $user->email = strtolower($request->email);
        $user->password = Hash::make($request->password);
        $user->email_verified_at = \Carbon\Carbon::now();
        $user->id_outlet = $request->id_outlet;
        $user->role = $request->role;
        $simpan = $user->save();

        if ($simpan) {
            Session::flash('success', 'Register berhasil! Silahkan login untuk mengakses data');
            return view('index');
        } else {
            Session::flash('errors', ['' => 'Register gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('register');
        }
    }

    public function logout(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Logout Validate', 'Logout Validate');
        Auth::logout(); // menghapus session yang aktif
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }
}
