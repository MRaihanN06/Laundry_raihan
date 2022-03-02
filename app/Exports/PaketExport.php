<?php

namespace App\Exports;

use App\Models\Paket;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpParser\Builder\Function_;
use PhpParser\Node\Expr\FuncCall;
use Maatwebsite\Excel\Events\AfterSheet;

class PaketExport implements FromCollection, WithHeadings, WithEvents
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Paket::all();
    }

    public function headings(): array
    {
        return [
            'Id',
            'Id Outlet',
            'Jenis',
            'Nama Paket',
            'Harga',
            'Waktu Dibuat',
            'Waktu Diupdate'
        ];
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){

            }
        ];
    }
}
