<?php
    include_once ("./db/database.php");
    error_reporting(0);
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programa para Laboratorio</title>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="./css/style.css">
</head>
<body>
    <h1>Programa para Laboratorio:</h1>
    <form method="post" action="./php/validar.php">
        <h2>Iniciar sesión</h 2><br><br>
        <p>Usuario o correo:<input type="text" required placeholder="Ingrese su nombre de usuario o correo" name="nombre"></p>
        <p>Contraseña:<input type="password" required placeholder="Ingrese su contraseña" name="contraseña"></p>
        <input type="submit" value="Ingresar">
        <p>¿No tienes cuenta?</p><a href="./php/signup.php">Registrarse</a>
    </form>
</body>
</html>