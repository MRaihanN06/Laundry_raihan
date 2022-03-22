<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PDF User</title>
    <style>
        table.display td {
            text-align: center;
        }
    </style>
</head>
<body>
    <h1>
        <Center>
            Data User
        </Center>
    </h1>
    <table class="display expandable-table" border="1" cellspacing="0" style="width:100%" style="width:100%" id="tb-user">
        <thead style="background-color: aqua">
          <tr>
            <th>No</th>
            <th>Nama Lengkap</th>
            <th>Email</th>
            <th>Id Outlet</th>
            <th>Role</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr>
              <td>{{ $loop->iteration }}</td>
              <td>{{ $user->name }}</td>
              <td>{{ $user->email }}</td>
              <td>{{ $user->Outlet->nama ?? '' }}</td>
              <td>{{ $user->role }}</td>
            </tr>
          @endforeach
        </tbody>
    </table>
</body>
</html>