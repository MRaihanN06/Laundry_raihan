<?php

namespace App\Imports;

use App\Models\member;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MemberImport implements ToModel, WithHeadingRow
{
    /**
    * method model untuk menentukan data mana saja yang akan mengisi database
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Member([
        'nama'          => $row['nama'],
        'alamat'        => $row['alamat'],
        'jenis_kelamin' => $row['jenis_kelamin'],
        'tlp'           => $row['tlp']
        ]);
    }

    /**
     * headingrow untuk melewati baris sesuai keinginan
     */
    public function headingrow(): int {
        return 3;
    }
}
