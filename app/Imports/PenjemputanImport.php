<?php

namespace App\Imports;

use App\Models\Penjemputan;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithLimit;

class PenjemputanImport implements ToModel, WithHeadingRow
{
    /**
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

    public function headingrow(): int {
        return 3;
    }
}
