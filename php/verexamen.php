<?php
    include_once ("../db/database.php");
    include_once ("./seguridad.php");
    require_once realpath(__DIR__ . '/../vendor/autoload.php');

    error_reporting(0);

    $user = $_SESSION['usuario'];
    $persona = $_SESSION['persona'];

    if($persona['tipo'] != 'Doctor') {
        header("Location:./menu.php");
    }

    if($_SERVER['REQUEST_METHOD']==='GET'){
        if(isset($_GET['id']) && !empty($_GET['id'])) {
            $peticion = peticion("SELECT * FROM exam WHERE id_paciente = '{$_GET['id']}' AND resultados IS NOT NULL AND resultados != ''");
            $peticion2 = peticion("SELECT * FROM persona WHERE id = '{$_GET['id']}'");

            $examenes = [];

            while($exampaciente = mysqli_fetch_array($peticion)) {
                array_push($examenes, $exampaciente);
            }

            $cliente = mysqli_fetch_array($peticion2);

            $mpdf = new \Mpdf\Mpdf();

            $data = '';
            $data .= '<h1>Detalles de examen:</h1>';

            $data .= '<strong>Nombre del paciente:</strong>' . $cliente['nombre'] . '<br/>';
            $data .= '<strong>Nombre del doctor:</strong>' . $persona['nombre'] . '<br/>';

            foreach($examenes as $examen) {
                $data .= '<strong>Tipo de examen:</strong>' . $examen['tipo'] . '<br/>';
                $data .= '<strong>Resultados:</strong>' . $examen['resultados'] . '<br/>';
            }

            $mpdf->WriteHTML($data);
            $pdf = $mpdf -> Output('resultados.pdf','D');

            // peticion("UPDATE exam SET realizado = 1 WHERE id_paciente = '{$_GET['id']}' AND resultados IS NOT NULL AND resultados != ''");
        }
    }

    if($_SERVER['REQUEST_METHOD']==='GET'){
        if(isset($_GET['examen']) && !empty($_GET['examen'])) {
            peticion("DELETE FROM exam WHERE id = '{$_GET['examen']}'");
        }
    }

    if($_SERVER['REQUEST_METHOD']==='POST') {
        if(isset($_POST['guardar'])) {
            if(isset($_POST['examen'])) {
                $examenes = $_POST['examen'];
                foreach($examenes as $index => $examen) {
                    $peticion = peticion("UPDATE exam SET resultados = '$examen' WHERE id = '$index'");
                }
            }
        }
    }

    $peticion = peticion("SELECT id_paciente FROM exam WHERE id_doctor = '{$user['id']}' AND realizado = 0 GROUP BY id_paciente");
    $datosCliente = [];

    if(mysqli_num_rows($peticion) > 0) {
        while($exam = mysqli_fetch_array($peticion)) {
            $peticion2 = peticion("SELECT * FROM persona WHERE id = '{$exam['id_paciente']}'");
            $peticion3 = peticion("SELECT * FROM clientes WHERE id_persona = '{$exam['id_paciente']}'");
            $peticion4 = peticion("SELECT * FROM exam WHERE id_paciente = '{$exam['id_paciente']}' AND id_doctor = '{$user['id']}' AND realizado = 0");
            $examenes = [];

            while($exampaciente = mysqli_fetch_array($peticion4)) {
                array_push($examenes, $exampaciente);
            }

            $persona = mysqli_fetch_array($peticion2);
            $array2 = mysqli_fetch_array($peticion3);
            $persona['correo'] = $array2['correo'];
            $persona['examenes'] = $examenes;
            array_push($datosCliente, $persona);
        }
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
    <h1>VER EXÁMENES</h1>
    <h2>Recuerde guardar antes de enviar los PDFs.</h2>
    <form method="post">
        <input type="submit" value="Guardar" name="guardar">
        <a href="./menu.php" class="boton">Regresar</a>
        <?php foreach ($datosCliente as $cliente):?>
            <h2>Nombre del cliente: <span><?= $cliente['nombre']." ".$cliente['apellido'] ?></span></h2>
            <?php foreach ($cliente['examenes'] as $examen):?>
                <h2>Tipo de examen: <span><?= $examen['tipo'] ?></span></h2>
                <h2>Resultados de examen:</h2>
                <input type="text" name="examen[<?= $examen['id'] ?>]" placeholder="Ingrese los resultados del examen" value="<?= $examen['resultados'] ?>">
                <a href="./verexamen.php?examen=<?php echo $examen['id'] ?>" class="botonepico">Borrar examen</a>
            <?php endforeach ?>
            <a href="./verexamen.php?id=<?php echo $cliente['id'] ?>" class="botonepico">Descargar exámenes</a>
            <div class="separador"></div>
        <?php endforeach;?>
        <?php if (count($datosCliente) <= 0): ?>
            <h2>Sí va, no hay pacientes hoy. ¡Día libre! :v</h2>
        <?php endif; ?>
    </form>
</body>
</html>