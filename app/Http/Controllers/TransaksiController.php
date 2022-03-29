<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Outlet;
use App\Models\Member;
use App\Models\Paket;
use App\Models\DetailTransaksi;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Exports\LaporanExport;
use Carbon\Carbon;
use App\Models\logging;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Menampilkan view dan mengirimkan data dengan model
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        Logging::record(Auth::user(), 'Akses view Transaksi', 'view Transaksi');
        $data['member'] = Member::get();
        $data['DetailTransaksi'] = DetailTransaksi::get();
        $data['paket'] = Paket::where('id_outlet', auth()->user()->id_outlet)->get();
        $data['transaksi'] = Transaksi::where('id_outlet', auth()->user()->id_outlet)->get();

        return view('transaksi.index')->with($data);
    }

    /**
     * Menampilkan view dan mengirimkan data dengan model
     */
    public function Faktur()
    {
        Logging::record(Auth::user(), 'Akses view Faktur Transaksi', 'view Faktur Transaksi');
        $data['member'] = Member::get();
        $data['DetailTransaksi'] = DetailTransaksi::get();
        $data['paket'] = Paket::where('id_outlet', auth()->user()->id_outlet)->get();
        $data['transaksi'] = Transaksi::where('id_outlet', auth()->user()->id_outlet)->get();

        return view('transaksi.faktur')->with($data);
    }

    /**
     * Menampilkan view create data 
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Logging::record(Auth::user(), 'Akses Form Tambah Transaksi', 'view form Transaksi');
        return view('transaksi/index');
    }

    /**
     * Membuat kode Invoice secara otomatis
     */
    private function generateKodeInvoice()
    {
        Logging::record(Auth::user(), 'Akses Kode Invoice Transaksi', 'Kode Invoice Transaksi');
        $last = Transaksi::orderBy('id', 'desc')->first();
        $last = ($last == null ? 1 : $last->id + 1);
        $kode = sprintf('TKI' . date('ymd') . '%06d', $last);

        return $kode;
    }

    /**
     * Menyimpan data ke database yaitu transaksi dan detail transaksi sekaligus
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        Logging::record(Auth::user(), 'Akses Form Tambah Transaksi', 'view form Transaksi');
        $request->validate([
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
            'pembayaran' => 'required',
        ]);

        $request['id_outlet'] = auth()->user()->id_outlet;
        $request['kode_invoice'] = $this->generateKodeInvoice();
        $request['tgl_bayar'] = ($request->pembayaran == 0 ? NULL : date('Y-m-d H:i:s'));
        $request['status'] = 'baru';
        $request['pembayaran'] = ($request->pembayaran == 0 ? 'belum_dibayar' : 'dibayar');
        $request['id_user'] = auth()->user()->id;

        //input transaksi
        $input_transaksi = Transaksi::create($request->all());
        if ($input_transaksi == null) {
            return back()->withErrors([
                'transaksi' => 'Input transaksi gagal',
            ]);
        }

        //input detail pembelian
        foreach ($request->id_paket as $i => $v) {
            $input_detail = DetailTransaksi::create([
                'id_transaksi' => $input_transaksi->id,
                'id_paket' => $request->id_paket[$i],
                'qty' => $request->qty[$i],
                'keterangan' => ''
            ]);
        }

        return redirect('#')->with('success', 'New post has been added!');
    }

    /**
     * Menampilkan view edit dan menampilkan data yang akan diupdate
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        Logging::record(Auth::user(), 'Akses Form Update Transaksi', 'View Update Transaksi');
        return view('transaksi/edit', [
            'transaksi' => $transaksi
        ]);
    }

    /**
     * Proses update data
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        // dd($request);
        Logging::record(Auth::user(), 'Akses Update Transaksi', 'Update Transaksi');
        $validatedData = $request->validate([
            'status' => 'required',
            'pembayaran' => 'required'
        ]);

        $validatedData['pembayaran'] = ($request->pembayaran == 'belum_dibayar' ? 'belum_dibayar' : 'dibayar');
        $validatedData['tgl_bayar'] = ($request->pembayaran == 'dibayar') ? date('Y-m-d H:i:s') : null;


        transaksi::where('id', $transaksi->id)
            ->update($validatedData);

        return redirect(request()->segment(1) . '/transaksi')->with('success', 'Post has been edited!');
    }

    /**
     * Melakukan export data dari view dan database menjadi file excel
     */
    public function exportbelumData()
    {
        Logging::record(Auth::user(), 'Akses Export Excel Transaksi', 'Export Excel Transaksi');
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new LaporanExport, $date . '_Laporan.xlsx');
    }

    /**
    * Melakukan export data dari view dan database menjadi file PDF
    */
    public function laporanbelumPDF(Transaksi $transaksi)
    {

        Logging::record(Auth::user(), 'Akses Export PDF Transaksi', 'Export PDF Transaksi');
        $pdf = PDF::loadView('laporan.pdf', [
            'tb_transaksi' => Transaksi::all()
        ]);

        return $pdf->stream();
    }

    public function exportData()
    {
        Logging::record(Auth::user(), 'Akses Export Excel Transaksi', 'Export Excel Transaksi');
        $date =  date('Y-m-d H:i:s');
        return Excel::download(new LaporanExport, $date . '_Laporan.xlsx');
    }

    /**
    * Melakukan export data dari view dan database menjadi file PDF
    */
    public function laporanPDF(Transaksi $transaksi)
    {

        Logging::record(Auth::user(), 'Akses Export PDF Transaksi', 'Export PDF Transaksi');
        $pdf = PDF::loadView('laporan.pdf', [
            'tb_transaksi' => Transaksi::all()
        ]);

        return $pdf->stream();
    }

    /**
    * Melakukan export data dari view dan database menjadi file PDF yang dijadikan faktur
    */
    public function fakturPDF($id)
    {

        Logging::record(Auth::user(), 'Akses Export PDF Transaksi', 'Export PDF Transaksi');
        $transaksi = Transaksi::findOrFail($id);
        $pdf = PDF::loadView('transaksi.faktur', [
            'transaksi' => $transaksi
        ]);

        return $pdf->stream();
    }

    /**
     * Menentukan data yang ditampilkan sesuai tanggal yang ditentukan
     */
    public function laporan(Transaksi $transaksi)
    {
        Logging::record(Auth::user(), 'Akses Laporan', 'view Laporan');
        $data['transaksi'] = Transaksi::all();
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $data = Transaksi::whereBetween('created_at', [$start_date, $end_date])->get();
            $data = Transaksi::where('status', $transaksi->status = 'diambil')->where('pembayaran', $transaksi->pembayaran = 'dibayar')->get();
        } else {
            $data = Transaksi::latest()->get();
            $data = Transaksi::where('status', $transaksi->status = 'diambil')->where('pembayaran', $transaksi->pembayaran = 'dibayar')->get();
        }

        return view('/laporan/index', compact('data'));
    }

    public function laporanbelum(Transaksi $transaksi)
    {
        Logging::record(Auth::user(), 'Akses Laporan Lengkap', 'view Laporan Lengkap');
        $data['transaksi'] = Transaksi::all();
        if (request()->start_date || request()->end_date) {
            $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
            $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
            $data = Transaksi::whereBetween('created_at', [$start_date, $end_date])->get();
        } else {
            $data = Transaksi::latest()->get();
        }

        return view('/laporanbelum/index', compact('data'));
    }
}
