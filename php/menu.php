<?php
    include_once ("../db/database.php");
    include_once ("./seguridad.php");
    error_reporting(0);

    $user = $_SESSION['usuario'];
    $persona = $_SESSION['persona'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programa para Laboratorio</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>¡Bienvenid@, <?php print($user['usuario']); ?>!</h1>
    <a href="./menupaciente.php" class="boton">Ver datos de paciente</a>
    <?php if($persona['tipo'] == 'Doctor'): ?>
        <a href="./verexamen.php" class="boton">Ver exámenes</a>
    <?php endif; ?>
    <a href="./logout.php" class="boton">Cerrar sesión</a>
</body>
</html>