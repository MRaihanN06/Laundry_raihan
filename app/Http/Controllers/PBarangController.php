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

class PBarangController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        $validatedData = $request->validate([
            'nama_barang' => 'required',
            'qty' => 'required',
            'harga' => 'required',
            'waktu_beli' => 'required',
            'supplier' => 'required'
        ]);

        $validatedData['waktu_beli'] = now('d-m-Y h:i:s');

        PBarang::where('id', $pbarang->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/pbarang')->with('success', 'Post has been edited!');
    }

    /**
     * proses update Status dan tgl status
     */
    public function bstatus(request $request){
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
        $validatedData = PBarang::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/pbarang')->with('success', 'Post has been deleted!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportData()
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new PbarangExport, $date . '_PBarang.xlsx');
    }

    /**
     * Melakukan upload data excel dan meng importnya untuk dimasukan ke dalam database
     * dan menampilkan datanya ke view
     */
    public function importData(Request $request)
    {
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

        $pdf = PDF::loadView('PBarang.pdf', [
            'pbarang' => PBarang::all()
        ]);

        return $pdf->stream();
    }
}
