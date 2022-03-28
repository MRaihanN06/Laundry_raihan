<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Exports\BarangExport;
use App\Imports\BarangImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;


class BarangController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Barang', 'view barang');
        return view('barang/index', [
            'barang' => barang::all()
        ]);
    }

    /**
     * Menampilkan view create data 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Logging::record(Auth::user(), 'Akses Form Tambah Barang', 'view form barang');
        return view('barang/index');
    }

    /**
     * Menyimpan data ke database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Tambah Barang', 'Create Barang');
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'qty' => 'required',
            'kondisi' => 'required',
            'tanggal_pengadaan' => 'required',
        ]);


        barang::create($validatedData);

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        Logging::record(Auth::user(), 'Akses Form Update Barang', 'View Update Barang');
        return view('barang/edit', [
            'barang' => $barang
        ]);
    }

    /**
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
        Logging::record(Auth::user(), 'Akses Update Barang', 'Update Barang');
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'merk_barang' => 'required',
            'qty' => 'required',
            'kondisi' => 'required',
            'tanggal_pengadaan' => 'required'
        ]);


        barang::where('id', $barang->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/barang')->with('success', 'Post has been edited!');
    }

    /**
     * Menghapus data sesuai id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Logging::record(Auth::user(), 'Akses Delete Barang', 'Delete Barang');
        $validatedData = barang::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/barang')->with('success', 'Post has been deleted!');
    }


    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportData()
    {
        Logging::record(Auth::user(), 'Akses Export Excel Barang', 'Export Excel Barang');
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new BarangExport, $date . '_barang.xlsx');
    }

    /**
     * Melakukan upload data excel dan meng importnya untuk dimasukan ke dalam database
     * dan menampilkan datanya ke view
     */
    public function importData(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Import Excel Barang', 'Import Excel Barang');
        $request->validate([
            'file' => 'file|mimes:xlsx, xls, xlsm, xlsb'
        ]);

        if ($request) {
            Excel::import(new BarangImport, $request->file('file'));
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
    public function exportPDF(Barang $Barang)
    {
        Logging::record(Auth::user(), 'Akses Export PDF Barang', 'Export PDF Barang');
        $pdf = PDF::loadView('Barang.pdf', [
            'tb_barang' => Barang::all()
        ]);

        return $pdf->stream();
    }
}
