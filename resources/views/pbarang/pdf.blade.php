<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Barang</title>
    <style>
        table.display td {
            text-align: center;
        }

    </style>
</head>

<body>
    <h1>
        <Center>
            Data Barang
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-barang">
        <thead style="background-color: aqua">
            <tr>
                <th>No</th>
                <th>Nama Barang</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Waktu Beli</th>
                <th>Supplier</th>
                <th>Status</th>
                <th>Status Update</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pbarang as $p)
                <tr>
                    <td>{{ $loop->iteration }}
                    </td>
                    <td>{{ $p->nama_barang }}</td>
                    <td>{{ $p->qty }}</td>
                    <td>{{ $p->harga }}</td>
                    <td>{{ date('Y-m-d h:i:s', strtotime($p->waktu_beli)) }}</td>
                    <td>{{ $p->supplier }}</td>
                    <td>
                        @switch($p->bstatus)
                            @case('diajukan_beli')
                                Dianjukan Beli
                            @break

                            @case('habis')
                                Habis
                            @break

                            @case('tersedia')
                                Tersedia
                            @break

                            @default
                        @endswitch
                    </td>
                    <td>{{ $p->tgl_status }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
