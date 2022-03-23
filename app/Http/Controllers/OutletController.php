<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Exports\OutletExport;
use App\Imports\OutletImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class OutletController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('outlet/index', [
            'outlet' => outlet::all() 
        ]);
    }

    /**
     * Menampilkan view create data 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outlet/index');
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
            'nama'  => 'required',
            'alamat'  => 'required',
            'tlp'  => 'required'
        ]);

        outlet::create($validatedData);

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function edit(Outlet $outlet)
    {
        return view('outlet/edit', [
            'outlet' => $outlet
        ]);
    }

    /**
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Outlet $outlet)
    {
        $validatedData = $request->validate([
            'nama'  => 'required',
            'alamat'  => 'required',
            'tlp'  => 'required'
        ]);

        outlet::where('id', $outlet->id)
            ->update($validatedData);

        return redirect(request()->segment(1).'/outlet')->with('success', 'Post has been edited!');
    }

    /**
     * Menghapus data sesuai id
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = outlet::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1).'/outlet')->with('success', 'Post has been deleted!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportData() 
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new OutletExport, $date. '_outlet.xlsx');
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
        
        if ($request){
            Excel::import(new OutletImport, $request->file('file'));  
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
    public function exportPDF(Outlet $Outlet) {
  
        $pdf = PDF::loadView('Outlet.pdf', [
            'tb_outlet' => Outlet::all()
        ]);
        
        return $pdf->stream();
        
      }
}
