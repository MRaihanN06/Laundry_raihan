<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\user;
use App\Imports\PenjemputanImport;
use App\Exports\PenjemputanExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Models\penjemputan;
use Barryvdh\DomPDF\Facade\Pdf;

class penjemputanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['member'] = member::get();
        $data['user'] = user::get();
        $data['penjemputan'] = penjemputan::get();
        return view('penjemputan/index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penjemputan/index');
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
            'id_member' => 'required',
            'id_user' => 'required',
            'status' => 'required'
        ]);


        penjemputan::create($validatedData);

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\penjemputan  $penjemputan
     * @return \Illuminate\Http\Response
     */
    public function show(penjemputan $penjemputan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\penjemputan  $penjemputan
     * @return \Illuminate\Http\Response
     */
    public function edit(penjemputan $penjemputan)
    {
        return view('penjemputan/edit', [
            'penjemputan' => $penjemputan
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\penjemputan  $penjemputan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penjemputan $p, $id)
    {
        $validatedData = $request->validate([
            'id_member' => 'required',
            'id_user' => 'required',
            'status' => 'required'
        ]);
        $p = penjemputan::find($id);


        penjemputan::where('id', $p->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/penjemputan')->with('success', 'Post has been edited!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\penjemputan $penjemputan
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $validatedData = penjemputan::find($id);
        $validatedData->delete();
        return redirect(request()->segment(1) . '/penjemputan')->with('success', 'Post has been deleted!');
    }

    public function exportData()
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new PenjemputanExport, $date . '_penjemputan.xlsx');
    }

    public function importData(Request $request)
    {
        $request->validate([
            'file' => 'file|mimes:xlsx, xls, xlsm, xlsb'
        ]);

        if ($request) {
            Excel::import(new PenjemputanImport, $request->file('file'));
        } else {
            return back()->withErrors([
                'file' => "File Bukan Excel"
            ]);
        }

        return back()->with('success', 'All good!');
    }

    public function exportPDF(penjemputan $penjemputan)
    {

        $pdf = PDF::loadView('Penjemputan.pdf', [
            'tb_penjemputan' => penjemputan::all()
        ]);

        return $pdf->stream();
    }
}
