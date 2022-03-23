<?php

namespace App\Imports;

use App\Models\Penjemputan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class PenjemputanImport implements ToModel, WithHeadingRow
{
    /**
     * method model untuk menentukan data mana saja yang akan mengisi database
    * @param Collection $collection
    */
    public function model(array $row)
    {
        return new Penjemputan([
            'id_member' => $row['id_member'],
            'id_user' => $row['id_user'],
            'status' => $row['status'],
        ]);
    }

    /**
     * headingrow untuk melewati baris sesuai keinginan
     */
    public function headingrow(): int {
        return 3;
    }
}
