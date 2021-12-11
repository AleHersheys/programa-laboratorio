<?php
    include_once ("../db/database.php");
    include_once ("./seguridad.php");
    error_reporting(0);

    if($_SERVER['REQUEST_METHOD']==='GET'){
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            peticion("DELETE FROM persona WHERE id = '{$_GET['id']}'");
            peticion("DELETE FROM clientes WHERE id_persona = '{$_GET['id']}'");
        }
    }

    $peticion = peticion("SELECT * FROM persona WHERE tipo = 'Cliente'");
    $datosCliente = [];
    $user = $_SESSION['usuario'];
    $persona = $_SESSION['persona'];

    if(mysqli_num_rows($peticion) > 0) {
        while($array = mysqli_fetch_array($peticion)) {
           $peticion2 = peticion("SELECT * FROM clientes WHERE id_persona = '{$array['id']}'");
           $array2 = mysqli_fetch_array($peticion2);
           $array['correo'] = $array2['correo'];
           array_push($datosCliente, $array);
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programa para Laboratorio</title>
    <link rel="icon" href="../img/icon.png">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <h1>MENÚ DE PACIENTES</h1>
    <div class="contenedor"><br>
        <h2>Por favor, seleccione una opción:</h2><br>
            <a href="insert.php" class="boton">Nuevo paciente</a>
            <a href="menu.php" class="boton">Regresar</a>
            <?php if(count($datosCliente) > 0): ?>
            <table>
            <thead>
                    <tr class="head">
                        <td>Id:</td>
                        <td>Nombre:</td>
                        <td>Apellido:</td>
                        <td>Cédula:</td>
                        <td>Teléfono:</td>
                        <td>Correo:</td>
                        <td colspan="2">Acción:</td>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($datosCliente as $cliente): ?>
                        <tr class="tabla">
                            <td><?= $cliente['id'] ?></td>
                            <td><?= $cliente['nombre'] ?></td>
                            <td><?= $cliente['apellido'] ?></td>
                            <td><?= $cliente['cedula'] ?></td>
                            <td><?= $cliente['telefono'] ?></td>
                            <td><?= $cliente['correo'] ?></td>
                            <td class="boton"><a href="./examen.php?id=<?php echo $cliente['id'] ?>">Enviar examen</a></td>
                            <td class="boton"><a href="./menupaciente.php?id=<?php echo $cliente['id'] ?>">Borrar</a></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            <?php else:?>
                <h3>No se encontró nada.</h3>
            <?php endif; ?>
            </table>
    </div>
</body>
</html>