<?php

namespace App\Http\Controllers;

use App\Models\outlet;
use App\Models\paket;
use App\Imports\PaketImport;
use App\Exports\PaketExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;

class PaketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['outlet'] = outlet::get();
        $data['paket'] = paket::get();
        return view('paket/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paket/index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga' => 'required'
        ]);


        paket::create($validatedData);

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function show(Paket $paket)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function edit(Paket $paket)
    {
        return view('paket/edit', [
            'paket' => $paket
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paket $paket)
    {
        $validatedData = $request->validate([
            'id_outlet' => 'required',
            'jenis' => 'required',
            'nama_paket' => 'required',
            'harga'  => 'required'
        ]);


        paket::where('id', $paket->id)
            ->update($validatedData);

        return redirect(request()->segment(1).'/paket')->with('success', 'Post has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Paket  $paket
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = paket::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1).'/paket')->with('success', 'Post has been deleted!');
    }

    public function exportData() 
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new PaketExport, $date. '_paket.xlsx');
    }

    public function importData(Request $request) 
    {
        $request->validate([
            'file' => 'file|mimes:xlsx, xls, xlsm, xlsb'
        ]);
        
        if ($request){
            Excel::import(new PaketImport, $request->file('file'));  
        } else {
            return back()->withErrors([
                'file' => "File Bukan Excel"
            ]);
        }
        
        return back()->with('success', 'All good!');
    }

    public function exportPDF(Paket $Paket) {
  
        $pdf = PDF::loadView('Paket.pdf', [
            'tb_paket' => Paket::all()
        ]);
        
        return $pdf->stream();
        
      }
}
