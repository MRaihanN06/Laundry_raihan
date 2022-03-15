<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Paket</title>
    {{-- <style>
        table.display td {
            text-align: center;
        }
    </style> --}}
</head>

<body>
    <h1>
        <Center>
            Data Paket
        </Center>
    </h1>
    <table class="display expandable-table" style="width:100%" id="tb-paket">
        <thead>
            <tr>
                <th>No</th>
                <th>Id Outlet</th>
                <th>Jenis</th>
                <th>Nama Paket</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tb_paket as $paket)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $paket->outlet->nama ?? '' }}</td>
                    <td>
                        @switch($paket->jenis)
                            @case('kiloan')
                                Kiloan
                            @break

                            @case('selimut')
                                Selimut
                            @break

                            @case('bed_cover')
                                Bed Cover
                            @break

                            @case('kaos')
                                Kaos
                            @break

                            @case('lain')
                                Lainnya
                            @break

                            @default
                        @endswitch
                    </td>
                    <td>{{ $paket->nama_paket }}</td>
                    <td>Rp. {{ number_format($paket->harga) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>

</html>
