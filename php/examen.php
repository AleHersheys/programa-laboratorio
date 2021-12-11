<?php
    include_once ("../db/database.php");
    include_once ("./seguridad.php");
    error_reporting(0);

    $tipos = ['Audiometría', 'Espirometría', 'Rayos X', 'Ultrasonido', 'Hematología completa', 'Prueba de COVID-19', 'Chequeo general'];

    if(isset($_GET['id']) && !empty($_GET['id'])) {
        $_SESSION['id'] = $_GET['id'];
    }
    
    if($_SERVER['REQUEST_METHOD']==='GET'){
        if(!isset($_SESSION['id'])) {
            if(isset($_GET['id']) && !empty($_GET['id'])) {
                $_SESSION['id'] = $_GET['id'];
            } else {
                header('Location:./menupaciente.php');
            }
        }
    }
    
    $id = $_SESSION['id'];
    print($id);

    $peticion = peticion("SELECT * FROM persona WHERE tipo = 'Doctor'");
    $datosDoctor = [];

    if(mysqli_num_rows($peticion) > 0) {
        while($array = mysqli_fetch_array($peticion)) {
           array_push($datosDoctor, $array);
        }
    }

    if($_SERVER['REQUEST_METHOD']==='POST'){
        $_SESSION['datos'] = $_POST;
        header('Location: '.$_SERVER['PHP_SELF']."?".$_SERVER['QUERY_STRING']);
        exit;
    }

    if(isset($_SESSION['datos'])){
        $_POST = $_SESSION['datos'];
        if(isset($_POST['doctor']) && isset($_POST['tipo'])){

            $doctor = $_POST['doctor'];
            $tipo = $tipos[$_POST['tipo']];
    
            $peticion = peticion("INSERT INTO exam (id_doctor, id_paciente, tipo) VALUES ('$doctor', '$id', '$tipo')");
    
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
    <h1>EXÁMENES</h1>
    <h2>Por favor, rellene lo siguiente:</h2>
    <form method="post">
        <select name="doctor">
            <?php foreach ($datosDoctor as $doctor): ?>
                <option value="<?= $doctor['id'] ?>">
                    <?= $doctor['nombre']." ".$doctor['apellido'] ?>
                </option>
            <?php endforeach; ?>
        </select>
        <select name="tipo">
            <?php foreach($tipos as $index => $tipo): ?>
                <option value="<?= $index ?>">
                    <?= $tipo ?>
                </option>
            <?php endforeach; ?>
        </select>
        <input type="submit" value="Enviar">
        <a href="./menupaciente.php" class="boton">Regresar</a>
    </form>
</body>
</html>