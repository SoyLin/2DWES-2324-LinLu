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
<table>
<tr>
    <td>Indice</td>
    <td>Valor</td>
    <td>Suma</td>
</tr>
<?php
$contador=0;
$suma=0;
$sumaPares=0;
$sumaImpares=0;
for ($i=1; $contador <20 ; $i+=2) { 
    $impares[]= $i;
    echo "<tr>";        // nueva fila
    echo "<td> $contador </td>"; //primera celda = columna
    echo "<td> $impares[$contador] </td>"; //segunda
    echo "<td>" . $suma+= $impares[$contador] . "</td>"; //tercera
    echo "</tr>";
    if ($contador%2==0) { //0 entre cualquie nª da 0, por eso en caso de 0 no va a haber resto
        $sumaPares+= $impares[$contador];
    }
    else {
        $sumaImpares+= $impares[$contador];
    }
    $contador++;
}

?>
</table>    
<table>
    <tr>
        <td>Media posiciones pares</td>
        <td>Media posiciones impares</td>
    </tr>

<?php
echo "<tr> <td>" . $mediaPares= $sumaPares/10 . "</td>";
echo "<td>" . $mediaImpares= $sumaImpares/10 . " </td> </tr>";
?>   
</table>

</body>
</html>