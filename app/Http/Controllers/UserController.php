<?php

namespace App\Http\Controllers;

use App\Models\outlet;
use App\Models\user;
use App\Exports\UserExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class UserController extends Controller
{
    /**
     * Menampilkan view user dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $validatedData = user::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/user')->with('success', 'Post has been deleted!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportData()
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new UserExport, $date . '_user.xlsx');
    }

     /**
     * Melakukan export data dari view dan database menjadi file PDF
     */
    public function exportPDF(User $User)
    {

        $pdf = PDF::loadView('User.pdf', [
            'users' => User::all()
        ]);

        return $pdf->stream();
    }
}
