<?php

namespace App\Http\Controllers;

use App\Models\outlet;
use App\Models\user;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Menampilkan view user dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view User', 'view User');
        $data['outlet'] = outlet::get();
        $data['user'] = user::get();
        return view('user/index', $data);
    }

    /**
     * Menampilkan view create data 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Logging::record(Auth::user(), 'Akses Form Tambah User', 'view form User');
        return view('user/index');
    }

    /**
     * Menyimpan data ke database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Form Tambah User', 'view form User');
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'id_outlet' => 'required',
            'role' => 'required'
        ]);


        user::create($validatedData);

        return redirect('#')->with('success', 'New post has been added!');
    }


    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        Logging::record(Auth::user(), 'Akses Form Update User', 'View Update User');
        return view('user/edit', [
            'user' => $user
        ]);
    }

    /**
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user $user)
    {
        Logging::record(Auth::user(), 'Akses Update User', 'Update User');
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'id_outlet' => 'required',
            'role' => 'required'
        ]);


        user::where('id', $user->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/user')->with('success', 'Post has been edited!');
    }

    /**
     * Menghapus data sesuai id
     *
     * @param  \App\Models\user  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Logging::record(Auth::user(), 'Akses Delete User', 'Delete User');
        $validatedData = user::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/user')->with('success', 'Post has been deleted!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportData()
    {
        Logging::record(Auth::user(), 'Akses Export Excel User', 'Export Excel User');
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new UserExport, $date . '_user.xlsx');
    }

     /**
     * Melakukan export data dari view dan database menjadi file PDF
     */
    public function exportPDF(User $User)
    {
        Logging::record(Auth::user(), 'Akses Export PDF User', 'Export PDF User');
        $pdf = PDF::loadView('User.pdf', [
            'users' => User::all()
        ]);

        return $pdf->stream();
    }
}
