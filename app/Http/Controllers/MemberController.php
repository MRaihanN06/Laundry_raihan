<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Exports\MemberExport;
use App\Imports\MemberImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class MemberController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Member', 'view Member');
        return view('member/index', [
            'member' => member::all()
        ]);
    }

    /**
     * Menampilkan view create data 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Logging::record(Auth::user(), 'Akses Form Tambah Member', 'view form Member');
        return view('member/index');
    }

    /**
     * Menyimpan data ke database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Form Tambah Member', 'view form Member');
        $validatedData = $request->validate([
            'nama'  => 'required',
            'alamat'  => 'required',
            'jenis_kelamin'  => 'required',
            'tlp'  => 'required'
        ]);

        member::create($validatedData);

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function edit(Member $member)
    {
        Logging::record(Auth::user(), 'Akses Form Update Member', 'View Update Member');
        return view('member/edit', [
            'member' => $member
        ]);
    }

    /**
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Member $member
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Member $member)
    {
        Logging::record(Auth::user(), 'Akses Update Member', 'Update Member');
        $validatedData = $request->validate([
            'nama'  => 'required',
            'alamat'  => 'required',
            'jenis_kelamin'  => 'required',
            'tlp'  => 'required'
        ]);

        member::where('id', $member->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/member')->with('success', 'Post has been edited!');
    }

    /**
     * Menghapus data sesuai id
     *
     * @param  \App\Models\Member  $member
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Logging::record(Auth::user(), 'Akses Delete Member', 'Delete Member');
        $validatedData = member::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/member')->with('success', 'Post has been deleted!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportData()
    {
        Logging::record(Auth::user(), 'Akses Export Excel Member', 'Export Excel Member');
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new MemberExport, $date . '_member.xlsx');
    }

    /**
     * Melakukan upload data excel dan meng importnya untuk dimasukan ke dalam database
     * dan menampilkan datanya ke view
     */
    public function importData(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Import Excel Member', 'Import Excel Member');
        $request->validate([
            'file' => 'file|mimes:xlsx, xls, xlsm, xlsb'
        ]);

        if ($request) {
            Excel::import(new MemberImport, $request->file('file'));
        } else {
            return back()->withErrors([
                'file' => "File Bukan Excel"
            ]);
        }

        return back()->with('success', 'All good!');
    }

     /**
     * Melakukan export data dari view dan database menjadi file PDF
     */
    public function exportPDF(Member $Member)
    {

        Logging::record(Auth::user(), 'Akses Export PDF Member', 'Export PDF Member');
        $pdf = PDF::loadView('Member.pdf', [
            'tb_member' => Member::all()
        ]);

        return $pdf->stream();
    }
}
