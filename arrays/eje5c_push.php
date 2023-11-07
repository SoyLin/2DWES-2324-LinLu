<?php
//modifica el array original
$array1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
$array2 = array("Sistemas Informáticos","FOL","Mecanizado");
$array3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");

$array4 = array();
array_push($array4,$array1, $array2, $array3);

echo "<pre>";
print_r($array4);
echo "</pre>";
?>