<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
<a href="./eminicio.html">Volver a la Página de Inicio</a>

<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Búsqueda por fecha</h2>  
<p>Introducir una fecha y se va a mostrar los empleados junto con su departamento que trabajan <u>durante ese tiempo</u>
</p>   
    <?php
        require_once('./funciones.php');     
     
     try {
        $conn = conexion();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
        
    ?>
        <label>Introduce una fecha: 
            <input type="text" name="fecha">
        </label><br>

        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar

    $fecha = $_POST["fecha"];
    $longitud= strlen($fecha);
    $longitud++;
    $fecha = str_pad($fecha,$longitud,"%");
    echo $fecha;




    $stmt2 = $conn->prepare("SELECT emple_depart.dni, CONCAT (nombre,' ',apellidos) AS NomApe,departamento.nombre_dpto,emple_depart.fecha_ini,emple_depart.fecha_fin from emple_depart,empleado,departamento 
                            WHERE emple_depart.cod_dpto = departamento.cod_dpto
                            AND emple_depart.dni = empleado.dni 
                            AND ( ( fecha_ini <= :fecha && fecha_fin >= :fecha) || (fecha_ini <= :fecha && fecha_fin is null))");
    $stmt2->bindParam(':fecha',$fecha); //seguridad, evitar inyección
    $stmt2->execute();
    $resultado = $stmt2->fetchAll(PDO::FETCH_ASSOC);

    echo "New records created successfully" . "<br>";

    echo "<br><table>";
    echo "<tr> <td>DNI</td> <td>Nombre y Apellidos</td> <td>Departamento</td> <td>Fecha inicio</td> <td>Fecha fin</td></tr>";

    foreach($resultado as $row) {
        echo "<tr>";
        echo "<td>" . $row["dni"] . "</td>";     
        echo "<td>" . $row["NomApe"] . "</td>";   
        echo "<td>" . $row["nombre_dpto"] . "</td>";  
        echo "<td>" . $row["fecha_ini"] . "</td>";  
        echo "<td>" . $row["fecha_fin"] . "</td>";  
        echo "</tr>";
    }
    echo "</table>";


    }
    }
    
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 

    
?>