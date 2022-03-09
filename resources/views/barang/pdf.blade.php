<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Barang</title>
    {{-- <style>
        table.display td {
            text-align: center;
        }
    </style> --}}
</head>

<body>
    <h1>
        <Center>
            Data Barang
        </Center>
    </h1>
    <table class="display expandable-table" style="width:100%" id="tb-barang">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Merk Barang</th>
                <th>Qty</th>
                <th>Kondisi</th>
                <th>Tanggal Pengadaan</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tb_barang as $b)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $b->nama_barang }}</td>
                    <td>{{ $b->merk_barang }}</td>
                    <td>{{ $b->qty }}</td>
                    <td>
                        @switch($b->kondisi)
                            @case('layak_pakai')
                                Layar Pakai
                            @break

                            @case('rusak_ringan')
                                Rusak Ringan
                            @break

                            @case('rusak_berat')
                                Rusak Berat
                            @break

                            @default
                        @endswitch
                    </td>
                    <td>{{ $b->tanggal_pengadaan }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
