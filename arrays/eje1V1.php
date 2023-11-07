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
$contador=0;
for ($i=1; $contador <20 ; $i+=2) { //no es $i+2 porque el valor no actualiza en $i
    $impares[]= $i;
    $contador++;
}

for ($j=0; $j <20 ; $j++) { 
    $suma[] += ( $suma[$j-1]+$impares[$j]); //esto es igual al suma = suma+impares[$j]
                                            //con el valor que teníamos + el nuevo valor
}

echo "<table>";
$z=0;
echo "<tr> <td>Indice</td> <td>Valor</td> <td>Suma</td> </tr>";
foreach ($impares as $key => $value) {
    echo "<tr>";        // nueva fila
    echo "<td> $key </td>"; //primera celda = columna
    echo "<td> $value </td>"; //segunda
    echo "<td> $suma[$z] </td>"; //tercera, imprimir array suma
    echo "</tr>";
    $z++; //control de posición
}
echo "</table>";

?>

</body>
</html>