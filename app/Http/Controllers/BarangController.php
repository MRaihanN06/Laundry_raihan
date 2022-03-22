<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Exports\BarangExport;
use App\Imports\BarangImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class BarangController extends Controller
{
    /**
     * untuk menampilkan view barang dan mengirimkan data barang dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('barang/index', [
            'barang' => barang::all()
        ]);
    }

    /**
     * untuk menampilkan view create data 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('barang/index');
    }

    /**
     * Store untuk menyimpan data ke database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
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
     * menampilkan view edit dan menampilkan data barang yang akan diupdate
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Barang $barang)
    {
        return view('barang/edit', [
            'barang' => $barang
        ]);
    }

    /**
     * Update untuk proses update data barang
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, barang $barang)
    {
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
     * untuk menghapus data barang sesuai id
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = barang::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/barang')->with('success', 'Post has been deleted!');
    }


    /**
     * untuk melakukan export data dari view dan database menjadi file excel
     */
    public function exportData()
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new BarangExport, $date . '_barang.xlsx');
    }

    /**
     * untuk melakukan upload data excel dan meng importnya untuk dimasukan ke dalam database
     * dan menampilkan datanya ke view
     */
    public function importData(Request $request)
    {
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
     * untuk melakukan export data dari view dan database menjadi file PDF
     */
    public function exportPDF(Barang $Barang)
    {

        $pdf = PDF::loadView('Barang.pdf', [
            'tb_barang' => Barang::all()
        ]);

        return $pdf->stream();
    }
}
