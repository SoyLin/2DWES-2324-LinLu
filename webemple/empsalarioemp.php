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
<h2>Modificación de salario</h2>
     
        <?php
        
        require_once('./funciones.php');     
         
     try {
        
        //Establecer la conexion
         $conn = conexion();
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
         //imprimir lista de empleados 
         tabla_emple($conn);
       
        
        ?>
        <label>Introduce el porcentaje de la modificación
            <input type="text" name="porcentaje">
        </label><br>

        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar

    //almacena el codigo de departamento en tabla trabaja (relación N:N)
    $emple_seleccionado = $_POST["emple_seleccionado"];
    $porcentaje = $_POST["porcentaje"];

    //funcion que convierte % a fraccion decimal
    $porcentaje = porcentaje($porcentaje);
    echo "fraccion decimal: " . $porcentaje . "<br>";


    $stmt2 = $conn->prepare("SELECT salario FROM empleado WHERE dni = :dni");
    $stmt2->bindParam(':dni',$emple_seleccionado); //seguridad, evitar inyección
    $stmt2->execute();
    $resultado = $stmt2->fetch(PDO::FETCH_ASSOC);
    $salario = $resultado["salario"];


    //calcular salario
    $salario += ($salario*$porcentaje);   
    echo "salario modificado: " . $salario . "<br>";

    
    $stmt3 = $conn->prepare("UPDATE empleado SET salario = :salario WHERE dni = :dni "); 
    $stmt3->bindParam(':dni',$emple_seleccionado); //seguridad, evitar inyección
    $stmt3->bindParam(':salario',$salario); //seguridad, evitar inyección
    $stmt3->execute();

 
    echo "New records created successfully" . "<br>";

    }
    }
    
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 

    
?>
