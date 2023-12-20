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
<h2>Listado de empleados</h2>
     
        <?php
         require_once('./funciones.php');
     
         
     try {
        $conn = conexion();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
     
        $mensaje = "Selecciona departamento: ";
        tabla_dpto($conn,$mensaje);

        
        ?>

        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar

    //almacena el codigo de departamento en tabla trabaja (relación N:N)
    $dpto_seleccionado = $_POST["dpto_seleccionado"];

    $stmt2 = $conn->prepare("SELECT emple_depart.dni, CONCAT (nombre,' ',apellidos) AS NomApe, fecha_ini FROM empleado,emple_depart  
                            WHERE emple_depart.dni = empleado.dni
                            AND cod_dpto = :cod_dpto
                            AND fecha_fin IS NULL ");
    $stmt2->bindParam(':cod_dpto',$dpto_seleccionado); //seguridad, evitar inyección
    $stmt2->execute();
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    $resultado = $stmt2->fetchAll();
 
    echo "New records created successfully" . "<br>";

    $fecha = "fecha_ini";
    bucle_mostrar_table($resultado,$fecha);


    }
    }
    
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 


    
?>
