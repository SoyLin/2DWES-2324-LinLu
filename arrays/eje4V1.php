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
//Me gusta más esta versión

echo "<table>";
echo "<tr> <th>Indice</th> <th>Binario</th> <th>Octal</th> </tr>";
//只要for结束，里面的东西不会再imprimir，就算contador++ 也没用，因为for已经停了
$contador=0; //contador 只是拿来imprimir índices; for转几次contador imprimir几次，她们的iteración是一样的
for ($j=19; $j >=0 ; $j--) { 
    $binario[]=decbin($j);
    echo "<tr>";
    echo "<td>" . $contador ."</td>"; //$contador 只不过是当中valor用的，并不是拿来controlar vueltas的，这是两码事要去分清。如果variable的名字换成$valor看的更清楚
    echo "<td>" . $binario[$contador] . "</td>";
    echo "<td>" . decoct($contador) . "</td>";
    echo "</tr>";
    $contador++;
}


?>

</body>
</html>