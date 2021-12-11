<?php
    include_once ("../db/database.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programa para Laboratorio</title>
    <link rel="icon" href="./img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>Programa para Laboratorio:</h1>
    <form method="post" action="validar.php">
        <h2>Registrarse</h2> <br>
        <p>Usuario:<input type="text" placeholder="Ingrese su nombre de usuario" name="nombre"></p>
        <p>Contraseña:<input type="password" placeholder="Ingrese su contraseña" name="contraseña"></p>
        <p>Confirmar contraseña:<input type="password" placeholder="Confirme su contraseña" name="confirmar_contraseña"></p>
        <p>Correo electrónico:<input type="password" placeholder="Ingrese su correo electrónico" name="correo"></p>
        <input type="submit" value="Crear">
        <p>¿Ya tienes cuenta?</p><a href="../index.php">Iniciar sesión</a>
    </form>
</body>
</html>