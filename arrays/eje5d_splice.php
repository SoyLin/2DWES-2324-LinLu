<?php
//我在看到这题就想到array_splice了，太聪明了我！正是因为我把funcion都剖析的很彻底，所以马上就想到了
//并且在2-3min就写完了哈哈哈哈哈哈哈哈哈哈!!!
$array1 = array("Bases Datos", "Entornos Desarrollo", "Programación");
$array2 = array("Sistemas Informáticos","FOL","Mecanizado");
$array3 = array("Desarrollo Web ES","Desarrollo Web EC","Despliegue","Desarrollo Interfaces", "Inglés");

$array4 = array(); //iniciar array sin elementos
array_splice($array4,0,0,$array1);
array_splice($array4,3,0,$array2);
array_splice($array4,6,0,$array3);
//array_splice($array4,11,0,"hola"); hace lo mismo que push, directamente podemos añadir un valor depués,算是高阶版
echo "<pre>";
print_r($array4);
echo "</pre>";
?>