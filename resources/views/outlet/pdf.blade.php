<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Outlet</title>
    {{-- <style>
        table.display td {
            text-align: center;
        }
    </style> --}}
</head>
<body>
    <h1>
        <Center>
            Data Outlet
        </Center>
    </h1>
    <table class="display expandable-table" style="width:100%" id="tb-outlet">
        <thead>
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>No Telepon</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tb_outlet as $outlet)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $outlet->nama }}</td>
              <td>{{ $outlet->alamat }}</td>
              <td>{{ $outlet->tlp }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
</body>
</html>