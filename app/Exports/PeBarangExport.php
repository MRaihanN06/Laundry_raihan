<?php

namespace App\Exports;

use App\Models\PeBarang;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Events\AfterSheet;

class PeBarangExport implements FromCollection, WithHeadings, WithEvents, WithMapping
{
    /**
     * Method collection untuk mengambil semua data dari database
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // return Paket::where('id_outlet', auth()->user()->id_outlet)->get();
        return PeBarang::all();
    }

    /**
     * Method map untuk menentukan atau menyeleksi field yang mengisi Excel
     */
    public function map($pebarang): array
    {
        return [
            $pebarang->id,
            $pebarang->nama_barang,
            $pebarang->waktu_pakai,
            $pebarang->waktu_beres,
            $pebarang->nama_pemakai,
            $pebarang->pestatus,
            $pebarang->created_at,
            $pebarang->updated_at,
        ];
    }

    /**
     * Method headings untuk mengatur nama header pada file excel yang akan diexport
     */
    public function headings(): array
    {
        return [
            'No',
            'Nama Barang',
            'Waktu Pakai',
            'Waktu Beres',
            'Nama Pemakai',
            'Status',
            'Waktu Dibuat',
            'Waktu Diupdate'
        ];
    }

    /**
     * method registerEvent untuk men-style keseluruhan file excel,
     * seperti getColumnDimension memberi jarak pada tiap kolom secara otomatis
     * mergeCells menyatukan coloum untuk judul excel
     * getFont + setBold untuk menebalkan font
     * getAligment untuk menengahkan posisi judul excel
     * getHighesRow + border untuk menambhakan border pada coloum tertentu samapi data akhir
     */
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $event->sheet->getColumnDimension('A')->setAutoSize(true);
                $event->sheet->getColumnDimension('B')->setAutoSize(true);
                $event->sheet->getColumnDimension('C')->setAutoSize(true);
                $event->sheet->getColumnDimension('D')->setAutoSize(true);
                $event->sheet->getColumnDimension('E')->setAutoSize(true);
                $event->sheet->getColumnDimension('F')->setAutoSize(true);
                $event->sheet->getColumnDimension('G')->setAutoSize(true);
                $event->sheet->getColumnDimension('H')->setAutoSize(true);

                $event->sheet->insertNewRowBefore(1, 2);
                $event->sheet->mergeCells('A1:H1');
                $event->sheet->setCellValue('A1', 'DATA PENGGUNAAN BARANG');
                $event->sheet->getStyle('A1')->getFont()->setBold(true);
                $event->sheet->getStyle('A1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
                $event->sheet->getStyle('A3:H' . $event->sheet->getHighestRow())->applyFromArray([
                    'borders' => [
                        'allBorders' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                            'color' => ['argb' => '252525'],
                        ],
                    ],
                ]);
            }
        ];
    }
}
