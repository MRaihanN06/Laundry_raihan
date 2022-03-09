<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Faktur</title>
    {{-- <style>
        table.display td {
            text-align: center;
        }
    </style> --}}
</head>

<body>
    <h1>
        <Center>
            Faktur
        </Center>
    </h1>

    <table class="expandable-table w-100 table-sm">
        <tbody>
            <tr>
                <td>
                    <b><img src="{{ public_path('assets') }}/images/favicon.png" class="mr-2">Laundry
                        MRaihanN
                    </b> <br>
                    Alamat : {{ $transaksi->outlet->alamat ?? '' }} <br>
                    Telepon : {{ $transaksi->outlet->tlp ?? '' }} <br>
                    Operator : {{ $transaksi->user->name ?? '' }} <br>
                    Outlet : {{ $transaksi->outlet->nama ?? '' }}
                </td>
                <td>
                    <b>Faktur No. {{ $transaksi->kode_invoice }} </b> <br>
                    {{ $transaksi->tgl_bayar }} <br>
                    Kepada Yth : <br>
                    {{ $transaksi->member->nama ?? '' }} <br>
                    {{ $transaksi->member->alamat ?? '' }} <br>
                    {{ $transaksi->member->tlp ?? '' }} <br>
                </td>
            </tr>
        </tbody>
    </table>
    <br>
    <table class="expandable-table w-100 table-sm" style="width: 100% ">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Paket</th>
                <th>Harga</th>
                <th>Qty</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody style="text-align: center;">
            @foreach ($transaksi->DetailTransaksi as $dt)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $dt->paket->nama_paket ?? '' }}</td>
                    <td>{{ $dt->paket->harga ?? '' }}</td>
                    <td>{{ $dt->qty }}</td>
                    <td>{{ ($dt->paket->harga ?? '') * $dt->qty }}</td>
                </tr>
            @endforeach
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right">Subtotal</td>
                <td>{{ $transaksi->getTotalPrice() }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right">Diskon</td>
                <td>{{ $transaksi->diskon }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right">Pajak {{ $transaksi->pajak }} %</td>
                <td>{{ ($transaksi->getTotalPrice() * $transaksi->pajak) / 100 }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right">Biaya Tambahan</td>
                <td>{{ $transaksi->biaya_tambahan }}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td style="text-align: right">Total Bayar Akhir</td>
                <td>{{ $transaksi->total }}</td>
            </tr>
            <tr></tr>
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td colspan="2" style="text-align: right"><b>Dibayar Pada {{ $transaksi->tgl_bayar }}</b></td>
            </tr>
        </tbody>
    </table> <br> <br>

    <b>Perhatian</b>
    <ol>
        <li> Pengambilan brang dibayar tunai. </li>
        <li> Jika terjadi kehilangan/kerusakan kami hanya mengganti
            tidak lebih dari 2x ongkos cuci. </li>
        <li> Hak claim yang kami terima tidak lebih dari 24 jam dari
            pengambilan. </li>
    </ol>
    <b>Kami Tidak Bertanggung Jawab</b>
    <ol>
        <li> Susut/luntur karena sifat bahannya. </li>
        <li> Cucian yang tidak diambil tempo 1 bulan hilang/rusak. </li>
        <li> Bila terhadi kebakaran. </li>
    </ol>


</body>

</html>
