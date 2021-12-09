<?php
    $server = "localhost";
    $user = "";
    $password = "";
    $database = "laboratorio";

    $conn = mysql_connect($server, $user, $password, $database);

    if(!conn) {
        die("Conexión fallida.");
    }
?>