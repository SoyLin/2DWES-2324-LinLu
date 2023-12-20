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
<h2>Alta de empleados</h2>
        <label>Introduce el DNI   
        <input type="text" name="dni"> </label><br>

        <label>Introduce el nombre de empleado   
        <input type="text" name="nombre_emple"> </label><br>

        <label>Introduce los apellidos de empleado   
        <input type="text" name="apellido"> </label><br>

        <label for="fecha">Introduce el fecha de nacimiento</label>
        <input type="text" id="fecha" name="fecha_nac"><br>

        <label for="salario">Introduce el salario</label>
        <input type="text" id="salario" name="salario"><br>

        <label for="fecha_ini">fecha inicio</label>
        <input type="text" id="fecha_ini" name="fecha_ini"><br>

        <?php

        require_once('./funciones.php');
     
         
     try {
        //Establecer conexion
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

    //almacenar datos introducidos por el usuario (cogemos las informaciones introducidos por el usuario y las almacenas en una variable)
    $dni = $_POST["dni"];
    $nombre_emple = $_POST["nombre_emple"];
    $apellido = $_POST["apellido"];
    $fecha_nac = $_POST["fecha_nac"];
    $salario = $_POST["salario"];
    $fecha_ini = $_POST["fecha_ini"];
  
    //almacena el codigo de departamento en tabla trabaja (relación N:N)
    $dpto_seleccionado = $_POST["dpto_seleccionado"];

    //Insertar en table empleado   
    insert_emple($conn,$dni,$nombre_emple,$apellido,$fecha_nac,$salario);

    insert_empledpto($conn,$dni,$dpto_seleccionado,$fecha_ini);


//!!COMPROBAR tabla empleado y table trabaja. Porque se ha insertado en las 2 tablas! 

    echo "New records created successfully";
    }
    }
    
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 


    
?>
