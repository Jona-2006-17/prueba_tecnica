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

        <h2 class="titulo_formulario">Registro de Usuario</h2>
        <form method="POST" action="{{route('users.store')}}">
            @csrf
            <div class="grupo_inputs">
                <label for="name">Nombre</label>
                <input class="input" type="text" id="name" name="name" value="{{old('name')}}">
                @error('name')
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            
            <div class="grupo_inputs">
                <label for="email">Email</label>
                <input class="input" type="text" id="email" name="email" value="{{old('email')}}">
                @error('email')
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            
            <div class="grupo_inputs">
                <label for="phone">N° Telefono</label>
                <input class="input" type="text" id="phone" name="phone" value="{{old('dni')}}">
            </div>
            
            <div class="grupo_inputs">
                <label for="dni">DNI</label>
                <input class="input" type="text" id="dni" name="dni" value="{{old('dni')}}">
            </div>
            
            <div class="grupo_inputs">
                <label for="password">Contraseña</label>
                <input class="input" type="password" id="passsword" name="password" value="{{old('password')}}"> 
                @error('password')
                    <span class="error">{{$message}}</span>
                @enderror
            </div>
            

            <button class="btn" type="submit">Aceptar</button>
        </form>
    </div>
   
</body>
</html>