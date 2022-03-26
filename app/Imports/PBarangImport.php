<?php

namespace App\Imports;

use App\Models\PBarang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PBarangImport implements ToModel, WithHeadingRow
{
    /**
     * method model untuk menentukan data mana saja yang akan mengisi database
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new PBarang([
            'nama_barang' => $row['nama_barang'],
            'qty' => $row['qty'],
            'harga' => $row['harga'],
            'waktu_beli' => $row['waktu_beli'],
            'supplier' => $row['supplier'],
            'bstatus' => $row['bstatus'],
        ]);
    }

    /**
     * headingrow untuk melewati baris sesuai keinginan
     */
    public function headingrow(): int {
        return 3;
    }
}
