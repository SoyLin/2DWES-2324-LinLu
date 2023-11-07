<?php
$array1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
$array2 = array("Sistemas Informáticos","FOL","Mecanizado");
$array3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");

$contador = 0;
for ($i=0; $i <= 10; $i++) { 
    if ($i <3) {
        $array4[] = $array1[$i];
    }elseif ($i<6) {
        $array4[] = $array2[$contador];
        $contador++;
    }elseif ($i <=10) {
        static $contador=0;
        $array4[] = $array3[$contador];
        $contador++;
    }
}

echo "<pre>";
print_r($array4);
echo "</pre>";
?>