<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Document</title>
<style>
tr,th,td{
    border:solid 1px;
}
</style>
</head>
<body>

<?php
echo "<table>";
echo "<tr> <th>Indice</th> <th>Binario</th> <th>Octal</th> </tr>";
// crear array binario para tener valores guardados
for ($i=19; $i >=0 ; $i--) { //DIRECTAMENTE CREAMOS un array que guarda VALORES INVERSOS
    $binario[]=decbin($i);
}

for ($j=0; $j <20 ; $j++) {  //entonces a la hora de imprimir 
    $numeros[]=$j;
    echo "<tr>";
    echo "<td>" . $numeros[$j] ."</td>";
    echo "<td>" . $binario[$j] . "</td>";
    echo "<td>" . decoct($numeros[$j]) . "</td>";
    echo "</tr>";
}
echo "</table>";


?>

</body>
</html>