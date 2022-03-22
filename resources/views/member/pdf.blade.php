<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF Member</title>
    <style>
        table.display td {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>
        <Center>
            Data Member
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" id="tb-member">
        <thead style="background-color: aqua">
          <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Alamat</th>
            <th>Jenis Kelamin</th>
            <th>No Telepon</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($tb_member as $member)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $member->nama }}</td>
              <td>{{ $member->alamat }}</td>
              <td>{{ $member->jenis_kelamin }}</td>
              <td>{{ $member->tlp }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
</body>
</html>