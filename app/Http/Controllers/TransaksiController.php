<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use App\Models\Outlet;
use App\Models\Member;
use App\Models\Paket;
use App\Models\DetailTransaksi;

use Illuminate\Http\Request;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['member'] = Member::get();
        $data['paket'] = Paket::where('id_outlet', auth()->user()->id_outlet)->get();
        
        return view('transaksi.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    private function generateKodeInvoice(){
        $last =Transaksi::orderBy('id','desc')->first();
        $last = ($last == null?1:$last->id + 1);
        $kode = sprintf('TKI'.date('ymd').'%06d', $last);

        return $kode;
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $validatedData = $request->validate([
            'id_member' => 'required',
            'tgl' => 'required',
            'batas_waktu' => 'required',
            'id_paket' => 'required',
            'qty' => 'required',
            'bayar' => 'required',
        ]);
        
        DetailTransaksi::create($validatedData);

        $request['id_outlet'] = auth()->user()->id_outlet;
        $request['kode_invoice'] = $this->generateKodeInvoice();
        $request['tgl_bayar'] = ($request->bayar == 0?NULL:date('Y-m-d H:i:s'));
        $request['status'] = 'baru';
        $request['dibayar'] = ($request->bayar == 0?'belum_dibayar':'dibayar');
        $request['id_user'] = auth()->user()->id;

        //input transaksi
        $input_transaksi = Transaksi::create($request->all());
        if($input_transaksi == null){
            return back()->withErrors([
                'transaksi' => 'Input transaksi gagal',
            ]);
        }

        //input detail pembelian
        foreach($request->id_paket as $i => $v){
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
     * Display the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function show(Transaksi $transaksi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function edit(Transaksi $transaksi)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Transaksi  $transaksi
     * @return \Illuminate\Http\Response
     */
    public function destroy(Transaksi $transaksi)
    {
        //
    }
}
