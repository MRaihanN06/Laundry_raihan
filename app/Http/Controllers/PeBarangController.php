<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PeBarang;
use App\Exports\PeBarangExport;
use App\Imports\PeBarangImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class PeBarangController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Penggunaan Barang', 'view Penggunaan Barang');
        return view('pebarang/index', [
            'pebarang' => pebarang::all()
        ]);
    }

    /**
     * Menampilkan view create data
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Logging::record(Auth::user(), 'Akses Form Tambah Penggunaan Barang', 'view form Penggunaan Barang');
        return view('pebarang/index');
    }

    /**
     * Menyimpan data ke database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Form Tambah Penggunaan Barang', 'view form Penggunaan Barang');
        $request->validate([
            'nama_barang' => 'required',
            'waktu_pakai' => 'required',
            'nama_pemakai' => 'required'
        ]);

        $request['pestatus'] = 'belum_selesai';

        //input transaksi
        $input = PeBarang::create($request->all());
        if ($input == null) {
            return back()->withErrors([
                'transaksi' => 'Input transaksi gagal',
            ]);
        }

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PeBarang $pebarang)
    {
        Logging::record(Auth::user(), 'Akses Form Update Penggunaan Barang', 'View Update Penggunaan Barang');
        return view('pebarang/edit', [
            'pebarang' => $pebarang
        ]);
    }

    /**
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PeBarang $pebarang)
    {
        Logging::record(Auth::user(), 'Akses Update Penggunaan Barang', 'Update Penggunaan Barang');
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'waktu_pakai' => 'required',
            'nama_pemakai' => 'required'
        ]);

        PeBarang::where('id', $pebarang->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/pebarang')->with('success', 'Post has been edited!');
    }

    /**
     * proses update Status dan waktu beres
     */
    public function pestatus(request $request){
        Logging::record(Auth::user(), 'Akses Update Status Penggunaan Barang', 'Update Status Penggunaan Barang');
        $data = PeBarang::where('id',$request->id)->first();
        $data->pestatus = $request->pestatus;
        $data->waktu_beres = now();
        $update = $data->save();

        return response()->json([
            'waktu_beres' => date('Y-m-d h:i:s', strtotime($data->waktu_beres))
        ]);
    }


        /**
     * Menghapus data sesuai id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Logging::record(Auth::user(), 'Akses Delete Penggunaan Barang', 'Delete Penggunaan Barang');
        $validatedData = PeBarang::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/pebarang')->with('success', 'Post has been deleted!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportData()
    {
        Logging::record(Auth::user(), 'Akses Export Excel Penggunaan Barang', 'Export Excel Penggunaan Barang');
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new PebarangExport, $date . '_Penggunaan Barang.xlsx');
    }

    /**
     * Melakukan upload data excel dan meng importnya untuk dimasukan ke dalam database
     * dan menampilkan datanya ke view
     */
    public function importData(Request $request)
    {
        Logging::record(Auth::user(), 'Akses Import Excel Penggunaan Barang', 'Import Excel Penggunaan Barang');
        $request->validate([
            'file' => 'file|mimes:xlsx, xls, xlsm, xlsb'
        ]);

        if ($request) {
            Excel::import(new PebarangImport, $request->file('file'));
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
    public function exportPDF(PeBarang $pebarang)
    {

        Logging::record(Auth::user(), 'Akses Export PDF Penggunaan Barang', 'Export PDF Penggunaan Barang');
        $pdf = PDF::loadView('PeBarang.pdf', [
            'pebarang' => PeBarang::all()
        ]);

        return $pdf->stream();
    }
}
