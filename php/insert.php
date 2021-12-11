<?php
    include_once ("../db/database.php");
    include_once ("./seguridad.php");

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $_SESSION['datos'] = $_POST;
        header('Location: '.$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
        exit;
    }

    if(isset($_SESSION['datos'])){
        $_POST = $_SESSION['datos'];
        if(isset($_POST['nombre']) && isset($_POST['apellido']) && isset($_POST['cedula']) && isset($_POST['telefono']) && isset($_POST['correo'])){

            $nombre = $_POST['nombre'];
            $apellido = $_POST['apellido'];
            $cedula = $_POST['cedula'];
            $telefono = $_POST['telefono'];
            $correo = $_POST['correo'];
    
            $peticion = peticion("INSERT INTO persona (nombre, apellido, cedula, telefono, tipo) VALUES ('$nombre', '$apellido', '$cedula', '$telefono', 'Cliente')");
            $id_persona = $con-> insert_id;
            $peticion = peticion("INSERT INTO clientes (id_persona, correo) VALUES ('$id_persona', '$correo')");
    
            if($peticion) echo "Hecho.";
            else echo "Error.";
        }
        unset($_SESSION['datos']);
    }
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
    <div class="contenedor">
        <h1>AGREGAR NUEVO CLIENTE</h1>
        <h2>Por favor, inserte la información requerida:</h2>
        <form method="post">
            <div class="form-group">
                <input type="text" required name="nombre" placeholder="Ingrese su nombre" class="input__text">
                <input type="text" required name="apellido" placeholder="Ingrese su apellido" class="input__text">
                <input type="number" min="1" required name="cedula" placeholder="Ingrese su cédula" class="input__text">
                <input type="text" required name="telefono" placeholder="Ingrese su número de teléfono" class="input__text">
                <input type="email" required name="correo" placeholder="Ingrese su correo electrónico" class="input__text">
            </div>
            <div class="btn__group">
                <input type="submit" name="guardar" value="Guardar" class="btn btn__primary">
                <a href="./menu.php" class="btn btn__danger">Cancelar</a>
                
            </div>
        </form>
    </div>
</body>
</html>