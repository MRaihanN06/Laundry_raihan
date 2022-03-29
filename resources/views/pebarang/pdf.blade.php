<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Penggunaan Barang</title>
    <style>
        table.display td {
            text-align: center;
        }

    </style>
</head>

<body>
    <h1>
        <Center>
            Data Penggunaan Barang
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-barang">
        <thead style="background-color: aqua">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Waktu Pakai</th>
                <th>Waktu Selesai</th>
                <th>Nama Pemakai</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pebarang as $p)
                <tr>
                    <td>{{ $loop->iteration }}
                    </td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ date('Y-m-d h:i:s', strtotime($p->waktu_pakai)) }}</td>
                    <td>{{ $p->waktu_beres }}</td>
                    <td>{{ $p->nama_pemakai }}</td>
                    <td>
                        @switch($p->pestatus)
                            @case('selesai')
                                Selesai
                            @break

                            @case('belum_selesai')
                                Belum Selesai
                            @break
                            @default
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
