<?php
//Importante: no es ámbito superglobal, 
//porque: en realidad ha hecho una copia de los códigos del archivo externo
// y por eso podemos UTILIZAR las variables que tienen
//aunque no vemos, pero ha copiado los códigos
include("eje5d_splice.php");

$array4 = array_reverse($array4);
array_splice($array4,5,1);

echo "<pre>";
print_r($array4);
echo "</pre>";
?>