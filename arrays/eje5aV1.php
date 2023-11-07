<?php //03/11/23
//因为for的用法深深的刻在我脑海里，所以我能在写下for的时候，
//大脑在接收到这个点的时候（*1），瞬间回想起我掌握的有关for的所有重要信息，在这个时候想起就是大脑对我的反馈，她在提醒我for可以完美的解决这道题
//只有拥有完整基因的女人，才有超快的信息处理能力，也就是我们说的灵感
//（*1）for这个点刺激了一下大脑，她就像是一股电流飞快的通过了所有关于for的信息
$array1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
$array2 = array("Sistemas Informáticos","FOL","Mecanizado");
$array3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");

//我写的这道题最出彩的就是 $array4[] esto es super claro, php sabe el orden en que se almacena
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