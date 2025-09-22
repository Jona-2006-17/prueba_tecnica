<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Users - {{ config('app.name', 'Laravel') }}</title>
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @else
            <style>
                body { font-family: 'Instrument Sans', system-ui, sans-serif; margin: 0; padding: 20px; background: #f8f9fa; }
                .container { max-width: 1200px; margin: 0 auto; }
                h1 { color: #333; margin-bottom: 30px; }
                table { width: 100%; border-collapse: collapse; background: white; border-radius: 8px; overflow: hidden; box-shadow: 0 2px 10px rgba(0,0,0,0.1); }
                th, td { padding: 12px 15px; text-align: left; border-bottom: 1px solid #eee; }
                th { background: #f8f9fa; font-weight: 600; color: #555; }
                tr:hover { background: #f8f9fa; }
                .user-count { margin-bottom: 20px; font-size: 16px; color: #666; }
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
                .btn-edit {
                    background: #28a745;
                    color: white;
                    padding: 5px 10px;
                    text-decoration: none;
                    border-radius: 3px;
                    font-size: 12px;
                    margin-right: 5px;
                }
                .btn-edit:hover { background: #218838; }
                .btn-delete {
                    background: #dc3545;
                    color: white;
                    padding: 5px 10px;
                    border: none;
                    border-radius: 3px;
                    font-size: 12px;
                    cursor: pointer;
                }
                .btn-delete:hover { background: #c82333; }

                #success-message {
                    background: linear-gradient(135deg, #d4edda 0%, #c3e6cb 100%);
                    color: #155724;
                    padding: 15px 20px;
                    border-radius: 10px;
                    margin: 15px 0;
                    border-left: 5px solid #28a745;
                    box-shadow: 0 4px 15px rgba(40, 167, 69, 0.2);
                    position: relative;
                    overflow: hidden;
                    font-weight: 500;
                    font-size: 16px;
                    display: flex;
                    align-items: center;
                    gap: 12px;
                }
            </style>
        @endif
    </head>
    <body>
        @if ($message = Session::get('success'))
            <div id="success-message" class="alert alert-success">
                {{ $message }}
            </div>
            
            <script>
                setTimeout(function() {
                    document.getElementById('success-message').style.display = 'none';
                }, 3000); // Se oculta después de 3 segundos
            </script>
        @endif
        @if ($message = Session::get('file'))
            <div id="success-message2" class="alert alert-success">
                {{ $message }}
            </div>
            
            <script>
                setTimeout(function() {
                    document.getElementById('success-message2').style.display = 'none';
                }, 3000); // Se oculta después de 3 segundos
            </script>
        @endif
        <div class="container">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
                <h1 style="margin-bottom: 0;">Lista de Usuarios</h1>
                <a href="{{ route('users.create') }}" class="btn-create">
                    Crear usuarios
                </a>
            </div>
            <a href="{{route('users.mass-create')}}">Importar usuarios</a><br>
            <a href="{{route('users.mass-delete')}}">Eliminar usuarios masivamente</a>

            <div class="user-count">
                Total de usuarios: {{ $users->count() }}
            </div>

            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th>Teléfono</th>
                        <th>DNI</th>
                        <th>Fecha de registro</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->phone ?? 'N/A' }}</td>
                            <td>{{ $user->dni ?? 'N/A' }}</td>
                            <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user->id) }}" class="btn-edit">Editar</a>
                                <form style="display: inline;" method="POST" action="{{ route('users.destroy', $user->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-delete" onclick="return confirm('¿Estás seguro de eliminar este usuario?')">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 40px; color: #999;">
                                No hay usuarios registrados
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </body>
</html>