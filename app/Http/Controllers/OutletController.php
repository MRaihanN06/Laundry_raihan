<?php

namespace App\Http\Controllers;

use App\Models\Outlet;
use App\Exports\OutletExport;
use App\Imports\OutletImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('outlet/index');
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
            'nama'  => 'required',
            'alamat'  => 'required',
            'tlp'  => 'required'
        ]);

        outlet::create($validatedData);

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Outlet  $outlet
     * @return \Illuminate\Http\Response
     */
    public function show(Outlet $outlet)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
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
     * Update the specified resource in storage.
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
     * Remove the specified resource from storage.
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

    public function exportData() 
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new OutletExport, $date. '_outlet.xlsx');
    }

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
}
