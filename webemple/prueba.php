<?php
// //Calculo de porcentaje
// $porcentaje= "25%456%4/6";

// $token= strtok($porcentaje,"%");
// echo $token . "<br>";

// $token = strtok("");
// echo $token . "<br>";

// // $token = strtok("/");
// // echo $token .  "<br>";

// // $token = strtok("");
// // echo $token;

$fecha="2023";
$longitud= strlen($fecha);
$longitud++;
$fecha = str_pad($fecha,$longitud,"%");
echo $fecha;

?>