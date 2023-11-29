<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>CONSULTA EMPLEADOS</h2>
       
        <label for="cod">Introduce código departamento</label>
        <input type="text" id="cod" name="cod_dpto"><br>
        
        <input type="submit">
    </form>
</body>
</html>
<?php
     $servername = "localhost";
     $username = "root";
     $password = "rootroot";
     $dbname = "empleadosnn";
     
   
    
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //Consulta SELECT multitabla
    $stmt = $conn->prepare("SELECT nombre_emple, salario,fecha_nac,fecha_ini FROM empleado,emple_dpto
                            WHERE empleado.dni = emple_dpto.dni
                            AND cod_dpto = :cod_dpto");
   

    $stmt->bindParam(':cod_dpto', $cod_dpto);

    
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $cod_dpto = $_POST["cod_dpto"]; //Almacenar dato recogido

    $stmt->execute();

    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultado=$stmt->fetchAll();

    //imprimir tabla
    echo "<table>";
    echo "<tr> <td>Nombre</td> <td>Salario</td> <td>Fecha_nacimiento</td> <td>Fecha_inicio</td> </tr>";

    foreach($resultado as $row) {
        echo "<tr>";
        echo "<td>" . $row["nombre_emple"] . "</td>";
        echo "<td>" . $row["salario"] . "€". "</td>";
        echo "<td>" . $row["fecha_nac"] . "</td>";
        echo "<td>" . $row["fecha_ini"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    }
}
catch(PDOException $e) {
   echo "Error: " . $e->getMessage();
}
$conn = null;

// echo  $row["nombre_emple"]. "  " . $row["salario"]."€  " . $row["fecha_nac"] . " " . $row["fecha_ini"] . "<br>";

?>
