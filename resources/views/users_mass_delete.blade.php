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

        .grupo, .grupo2{
            max-width: 80%;
            margin: 1em auto;
        }

        .file{
            width: 400px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 5px 5px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 14px;
            text-transform: uppercase;
            letter-spacing: 0.5px;

        }
    </style>
</head>
<body>   
    <div class="container">
        <div class="grupo">
            <a href="{{route('users.index')}}">Volver</a>
            <h1>Eliminación Masiva de Usuarios</h1>
        </div>
        
        <form action="{{route('users.mass-destroy')}}" id="massDeleteForm" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="grupo2">
                <input class="file" type="file" name="file" ><br>
                <button class="file" type="submit" name="submit_file">Eliminar desde archivo</button>
            </div>
            <div class="grupo2">
                <input type="text" id="filterInput" placeholder="Buscar por nombre o email..." style="width: 400px; padding: 8px; border-radius: 5px; border: 1px solid #ccc;">
            </div>
            
            <table id="usersTable">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="selectAll"></th>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                        <tr>
                            <td><input type="checkbox" name="ids[]" value="{{ $user->id }}"></td>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                        </tr>
                    @empty
                        <h5>No hay usuarios registrados</h5>
                    @endforelse
                </tbody>
            </table>
            <div class="grupo2">
                <button type="submit" onclick="return confirm('¿Seguro que deseas eliminar los usuarios seleccionados?')">Eliminar seleccionados</button>
            </div>
        </form>
    </div>

    <script>
        document.getElementById('selectAll').addEventListener('change', function(){
            document.querySelectorAll('input[name="ids[]"]').forEach(cb => cb.checked = this.checked);
        });

        document.getElementById("filterInput").addEventListener("keyup", function() {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("#usersTable tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });
    </script>
    
</body>
</html>