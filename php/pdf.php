<?php
    require_once __DIR__ . '/vendor/autoload.php';

    $mpdf = new \Mpdf\Mpdf();

    $data = '';
    $data .= '<h1>Detalles de examen:</h1>';

    $data .= '<strong>Nombre del paciente:</strong>' . $name . '</br>';
    $data .= '<strong>Nombre del doctor:</strong>' . $doctor . '</br>';
    $data .= '<strong>Tipo de examen:</strong>' . $tipo . '</br>';
?>