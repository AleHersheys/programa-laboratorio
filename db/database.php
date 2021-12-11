<?php
    $server = "localhost";
    $user = "root";
    $password = "";
    $database = "laboratorio";

    $con = mysqli_connect($server, $user, $password, $database);
    
    if(!$con) {
        die("Conexión fallida.");
    }

    if(mysqli_connect_errno()){
        echo "Error de conexión a MySQL: " . mysqli_connect_error();
    }

    $timezone_identifier = 'America/Caracas';
    date_default_timezone_set($timezone_identifier);

    function peticion($peticion) {
        global $con;
        $respuesta = mysqli_query($con, $peticion) or die ('Error: ' . mysqli_error($con));
        return $respuesta;
    }
?>