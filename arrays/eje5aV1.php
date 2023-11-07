<?php //03/11/23

$array1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
$array2 = array("Sistemas Informáticos","FOL","Mecanizado");
$array3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");


//los valores, no hace falta ponerlos índices
for ($i=0; $i < count($array1) ; $i++) { 
    $array4[]= $array1[$i];
}
for ($i=0; $i < count($array2) ; $i++) { 
    $array4[]= $array2[$i];
}
for ($i=0; $i < count($array3) ; $i++) { 
    $array4[]= $array3[$i];
}

echo "<pre>";
print_r($array4);
echo "</pre>";
?>
