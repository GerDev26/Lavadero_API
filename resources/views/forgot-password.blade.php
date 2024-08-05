<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body class="bg-gray-500">
    <h1>Recuperar contraseña</h1>
    <p>¡Hola {{$user->name}}!</p>
    <p>Para cambiar tu contraseña puedes precionar este boton</p>
    <a href="http://localhost:5173/resetpassword?code={{$token['token']}}"> Crear nueva contraseña </a>
    <p>si no funciona copia y pega este enlace</p>
    <p>http://localhost:5173/resetpassword?code={{$token['token']}}</p>
</body>
</html>