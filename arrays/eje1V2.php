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
echo "<tr> <td>Indice</td> <td>Valor</td> <td>Suma</td> </tr>";
//una fila con 3 celdas/columnas

$contador=0;
$suma=0;
for ($i=1; $contador <20 ; $i+=2) { 
    $impares[]= $i;
    echo "<tr>";        // nueva fila
    echo "<td> $contador </td>"; //primera celda = columna
    echo "<td> $impares[$contador] </td>"; //segunda
    echo "<td>" . $suma+= $impares[$contador] . "</td>"; //tercera
    echo "</tr>";
    $contador++;
}

?>

</body>
</html>