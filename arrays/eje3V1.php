<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Document</title>
<style>
tr,td{
    border:solid 1px;
}
</style>
</head>
<body>
<?php
echo "<table>";
echo "<tr> <td>Indice</td> <td>Binario</td> <td>Octal</td> </tr>";

for ($i=0; $i < 20; $i++) { 
    $numero[]=$i;
    echo "<tr>";
    echo "<td>  $numero[$i] </td>";
    echo "<td>" . decbin($numero[$i]) . "</td>";
    echo "<td>" . decoct($numero[$i]) . "</td>";
    echo "</tr>";
}
//decbin($array[$i]) HACE CONVERSIÓN DE ARRAY !!
//decbin($i) HACE CONVERSIÓN DE CONTADOR!
//PERO SI contador Y array TIENEN MISMO VALOR ->  DA IGUAL CUALQUIER FORMA

?>

</body>
</html>