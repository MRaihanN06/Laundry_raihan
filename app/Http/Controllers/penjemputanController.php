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
     * Menampilkan view dan mengirimkan data dengan model
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
     * Menampilkan view create data 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('penjemputan/index');
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
            'id_member' => 'required',
            'id_user' => 'required',
            'status' => 'required'
        ]);


        penjemputan::create($validatedData);

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
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
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\penjemputan  $penjemputan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, penjemputan $p, $id)
    {
        $validatedData = $request->validate([
            'id_member' => 'required',
            'id_user' => 'required'
        ]);
        $p = penjemputan::find($id);


        penjemputan::where('id', $p->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/penjemputan')->with('success', 'Post has been edited!');
    }

    /**
     * Proses update data status
     */
    public function status(request $request){
        $data = penjemputan::where('id',$request->id)->first();
        $data->status = $request->status;
        $update = $data->save();

        return 'Data berhasil diupdate';
    }

    /**
     * Menghapus data sesuai id
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

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportData()
    {
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new PenjemputanExport, $date . '_penjemputan.xlsx');
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
            Excel::import(new PenjemputanImport, $request->file('file'));
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
    public function exportPDF(penjemputan $penjemputan)
    {

        $pdf = PDF::loadView('Penjemputan.pdf', [
            'tb_penjemputan' => penjemputan::all()
        ]);

        return $pdf->stream();
    }
}