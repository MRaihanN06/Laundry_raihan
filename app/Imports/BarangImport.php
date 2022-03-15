<?php

namespace App\Imports;

use App\Models\Barang;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;

class BarangImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Barang([
            'nama_barang'        => $row['nama_barang'],
            'merk_barang'        => $row['merk_barang'], 
            'qty'                => $row['qty'],
            'kondisi'            => $row['kondisi'],
            'tanggal_pengadaan'  => $row['tanggal_pengadaan']
        ]);
    }

    public function headingrow(): int {
        return 3;
    }
}
