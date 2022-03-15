<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF PENJEMPUTAN</title>
    {{-- <style>
        table.display td {
            text-align: center;
        }
    </style> --}}
</head>
<body>
    <h1>
        <Center>
            Data Penjemputan
        </Center>
    </h1>
   
    <table class="display expandable-table" style="width:100%" id="tb-penjemputan">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pelanggan</th>
                <th>Alamat Pelanggan</th>
                <th>No Telepon</th>
                <th>Penjemput</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tb_penjemputan as $p)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $p->member->nama ?? '' }}</td>
                    <td>{{ $p->member->alamat ?? '' }}</td>
                    <td>{{ $p->member->tlp ?? '' }}</td>
                    <td>{{ $p->user->name ?? '' }}</td>
                    <td>
                        @switch($p->status)
                            @case('tercatat')
                                Tercatat
                            @break

                            @case('penjemputan')
                                Penjemputan
                            @break

                            @case('selesai')
                                Selesai
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