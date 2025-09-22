<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        table { width: 80%; margin: 2em auto; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
        th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
        th { background: #f8f9fa; font-weight: 600; color: #555; }
        tr:hover { background: #f8f9fa; }
        

        .btn-create {
            background: #007bff;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: background 0.3s;
        }
        .btn-create:hover { background: #0056b3; }
    </style>
</head>
<body>
    <form method="POST" action="{{ route('users.mass-store') }}">
        @csrf
        <table cellpadding="8" cellspacing="0">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>DNI</th>
                    <th>Password</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rows as $clave => $row)
                    <tr>
                        <td>
                            <input type="hidden" name="users[{{ $clave }}][name]" value="{{ $row['name'] }}">
                            {{ $row['name'] }}
                        </td>
                        <td>
                            <input type="hidden" name="users[{{ $clave }}][email]" value="{{ $row['email'] }}">
                            {{ $row['email'] }}
                        </td>
                        <td>
                            <input type="hidden" name="users[{{ $clave }}][phone]" value="{{ $row['phone'] ?? '' }}">
                            {{ $row['phone'] ?? 'N/A' }}
                        </td>
                        <td>
                            <input type="hidden" name="users[{{ $clave }}][dni]" value="{{ $row['dni'] ?? '' }}">
                            {{ $row['dni'] ?? 'N/A' }}
                        </td>
                        <td>
                            <input type="hidden" name="users[{{ $clave }}][password]" value="{{ $row['password'] }}">
                            {{ $row['password'] ?? 'N/A' }}
                        </td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td>
                        <button class="btn-create" type="submit">Crear todos los usuarios</button>
                    </td>
                </tr>
            </tfoot>
        </table>

    </form>
</body>
</html>
