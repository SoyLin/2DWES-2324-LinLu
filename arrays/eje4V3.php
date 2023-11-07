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
//Es una versión con errores = una versión con me aporta muchas experiencias(conocimientos e informaciones)
//我会吸收这些送上门的经验值
//善于思考，所以我觉醒了，并且我能打破所有的虚假陷阱，找到真实，在这真实上建立属于我们的

echo "<table>";
echo "<tr> <th>Indice</th> <th>Binario</th> <th>Octal</th> </tr>";
for ($i=0; $i <20 ; $i++) { 
    $binario[]=decbin($i);
}
$reverse = array_reverse($binario);

for ($i=0; $i < 20; $i++) { 
    echo "<tr>";
    echo "<td>" . $i . "</td>";
    echo "<td>" . $reverse[$i] . "</td>";
    echo "<td>" . decoct($i) . "</td>";
    echo "</tr>";
}
?>

</body>
</html>