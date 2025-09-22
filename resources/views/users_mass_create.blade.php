<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        .container {
            margin: 2em auto;
            max-width: 500px;
            background: white;
            border-radius: 15px;
            padding: 40px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
            border: none;
        }
        .titulo_formulario {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
            font-size: 28px;
            font-weight: 300;
        }
        .grupo_inputs {
            margin-bottom: 20px;
        }

        .input{
            width: 95%;
            padding: 12px 15px;
            border: 2px solid #e1e5e9;
            border-radius: 8px;
            font-size: 16px;
            background: #f8f9fa;
        }

        .btn{
            width: 100%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn2{
            width: 90%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
            padding: 15px 20px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            margin-top: 20px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .error {
            color: #e74c3c;
            font-size: 13px;
            margin-top: 5px;
            padding: 8px 12px;
            background: #ffeaea;
            border-radius: 5px;
            border-left: 3px solid #e74c3c;
            display: block;
        }

    </style>
</head>
<body>
    <div class="container">
        <a href="{{route('users.index')}}">Volver</a>
        @if ($message = Session::get('file'))
            <div id="error_file" class="error">
                {{ $message }}
            </div>
            
            <script>
                setTimeout(function() {
                    document.getElementById('error_file').style.display = 'none';
                }, 5000);
            </script>
        @endif
        <h2 class="titulo_formulario">Importar Usuarios</h2>
        <p>
            ¿No sabes qué formato usar? 
            <a href="{{ route('users.csv-template') }}">
                Descarga la plantilla aquí
            </a>
        </p>
        <form action="{{ route('users.mass-preview') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input class="btn2" type="file" name="file" required> <br>
            <button class="btn" type="submit">Vista previa</button>
        </form> 

    </div>
   
</body>
</html>