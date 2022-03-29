<?php

namespace App\Imports;

use App\Models\PeBarang;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PeBarangImport implements ToModel, WithHeadingRow
{
    /**
     * method model untuk menentukan data mana saja yang akan mengisi database
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new PeBarang([
            'nama_barang' => $row['nama_barang'],
            'waktu_pakai' => $row['waktu_pakai'],
            'waktu_beres' => $row['waktu_beres'],
            'nama_pemakai' => $row['nama_pemakai'],
            'pestatus' => $row['status'],
        ]);
    }

    /**
     * headingrow untuk melewati baris sesuai keinginan
     */
    public function headingrow(): int {
        return 3;
    }
}
