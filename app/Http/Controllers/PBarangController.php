<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PBarang;
use App\Exports\PBarangExport;
use App\Imports\PBarangImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use GuzzleHttp\Psr7\Message;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

class PBarangController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Penggunaan Barang', 'view Penggunaan Barang');
        return view('pbarang/index', [
            'pbarang' => pbarang::all()
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
        return view('pbarang/index');
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
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required',
            'bstatus' => 'required',
        ]);

        PBarang::create($validatedData);

        return redirect('#')->with('success', 'New post has been added!');
    }


    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(PBarang $pbarang)
    {
        Logging::record(Auth::user(), 'Akses Form Update Penggunaan Barang', 'View Update Penggunaan Barang');
        return view('pbarang/edit', [
            'pbarang' => $pbarang
        ]);
    }

    /**
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PBarang $pbarang)
    {
        Logging::record(Auth::user(), 'Akses Update Penggunaan Barang', 'Update Penggunaan Barang');
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required'
        ]);

        PBarang::where('id', $pbarang->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/pbarang')->with('success', 'Post has been edited!');
    }

    /**
     * proses update Status dan tgl status
     */
    public function bstatus(request $request){
        Logging::record(Auth::user(), 'Akses Update Status Penggunaan Barang', 'Update Status Penggunaan Barang');
        $data = PBarang::where('id',$request->id)->first();
        $data->bstatus = $request->bstatus;
        $data->tgl_status = now();
        $update = $data->save();

        return response()->json([
            'tgl_status' => date('Y-m-d h:i:s', strtotime($data->tgl_status))
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
        $validatedData = PBarang::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/pbarang')->with('success', 'Post has been deleted!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportData()
    {
        Logging::record(Auth::user(), 'Akses Export Excel Penggunaan Barang', 'Export Excel Penggunaan Barang');
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new PbarangExport, $date . '_PBarang.xlsx');
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
            Excel::import(new PbarangImport, $request->file('file'));
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
    public function exportPDF(PBarang $pbarang)
    {

        Logging::record(Auth::user(), 'Akses Export PDF Penggunaan Barang', 'Export PDF Penggunaan Barang');
        $pdf = PDF::loadView('PBarang.pdf', [
            'pbarang' => PBarang::all()
        ]);

        return $pdf->stream();
    }
}
