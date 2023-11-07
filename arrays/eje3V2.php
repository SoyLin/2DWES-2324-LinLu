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
#EJE3 SIN ARRAY 
echo "<table>";
echo "<tr> <td>Indice</td> <td>Binario</td> <td>Octal</td> </tr>";

for ($i=0; $i < 20; $i++) { 
    echo "<tr>";
    echo "<td> $i </td>";
    echo "<td>" . decbin($i) . "</td>";
    echo "<td>" . decoct($i) . "</td>";
    echo "</tr>";
}


?>

</body>
</html>