<?php

$valor = "H800";
$valor1 = substr($valor,1);

// $valor1 = strrev($valor);
// $array = (str_split($valor1,3));

// print_r($array);
// $valor1 = $array[0];
$valor1++;
// echo $valor1;
if ($valor1<=9) {
    $valor1 = "00" . $valor1;
}elseif ($valor1<=99) {
    $valor1 = "0" . $valor1;
}
echo $valor1;


?>