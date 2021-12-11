<?php
    include_once ("../db/database.php");
    include_once ("./seguridad.php");

    if($_SERVER['REQUEST_METHOD'] == 'POST') {

    if(isset($_POST['nombre']) && isset($_POST['contraseña'])) {
      $nombre = $_POST['nombre'];
      $nombre = strtolower($nombre);
      $contraseña = $_POST['contraseña'];

    $peticion = peticion("SELECT * FROM userlab WHERE contraseña='".md5($contraseña)."' AND (usuario='$nombre' OR correo='$nombre')");

        if(mysqli_num_rows($peticion) > 0) {
            $_SESSION['usuario'] = mysqli_fetch_array($peticion);
            $user = $_SESSION['usuario'];
            $peticion = peticion("SELECT * FROM persona WHERE id = '{$user['id_persona']}'");
            $_SESSION['persona'] = mysqli_fetch_array($peticion);
            header("Location: menu.php");
        } else {
            header("Location: ../index.php");
        }
    }
}
?>