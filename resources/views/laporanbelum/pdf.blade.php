<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Laporan</title>
    <style>
        table.display td {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>
        <Center>
            Laporan 
        </Center>
    </h1>
   
    <table class="expandable-table w-100 table-sm" border="1" cellspacing="0" style="width:100%" id="tb-barang" id="tb-transaksi">
        <thead style="background-color: aqua">
            <tr>
                <th>No</th>
                <th>Nama Outlet</th>
                <th>Kode Invoice</th>
                <th>Nama Pelanggan</th>
                <th>Tanggal Masuk</th>
                <th>Tanggal Bayar</th>
                <th>Kasir</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tb_transaksi as $t)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $t->outlet->nama ?? '' }}</td>
                    <td>{{ $t->kode_invoice }}</td>
                    <td>{{ $t->member->nama ?? '' }}</td>
                    <td>{{ $t->tgl }}</td>
                    <td>{{ $t->tgl_bayar }}</td>
                    <td>{{ $t->user->name ?? '' }}</td>
                    <td>{{ $t->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

</body>
</html>