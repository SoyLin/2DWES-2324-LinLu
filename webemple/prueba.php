<?php
//Calculo de porcentaje
$porcentaje= "25%456%4/6";

$token= strtok($porcentaje,"%");
echo $token . "<br>";

$token = strtok("");
echo $token . "<br>";

// $token = strtok("/");
// echo $token .  "<br>";

// $token = strtok("");
// echo $token;



?>