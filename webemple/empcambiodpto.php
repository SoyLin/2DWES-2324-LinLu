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
<h2>Cambio de departamento </h2>
    
<?php

    require_once('./funciones.php');

 
try {
        //Establecer conexion
         $conn = conexion();
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         //Mostrar la lista de empleados
         tabla_emple($conn);
     
         //Mostrar lista de departamentos
         $mensaje = "Selecciona a qué departamente se va a trasladar:";
         tabla_dpto($conn,$mensaje);

        
        ?>
        
        <label for="fecha_fin">fecha fin en el antiguo departamento</label>
        <input type="text" id="fecha_fin" name="fecha_fin"><br>

        <label for="fecha_ini">fecha inicio en el nuevo departamento</label>
        <input type="text" id="fecha_ini" name="fecha_ini"><br>
        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar

    //almacenar datos seleccionado por el usuario 
    $dni = $_POST["emple_seleccionado"];
    $dpto_seleccionado = $_POST["dpto_seleccionado"];
    $fecha_fin = $_POST["fecha_fin"];
    $fecha_ini = $_POST["fecha_ini"];


    //sacar max fecha para insertar fecha_fin posteriormente
    $stmt3 = $conn->prepare("SELECT MAX(fecha_ini) AS max_fecha FROM `emple_depart` WHERE dni = :dni");
    $stmt3->bindParam(':dni',$dni); //seguridad, evitar inyección
    $stmt3->execute();
    $resultado = $stmt3 -> fetch(PDO::FETCH_ASSOC); //devuelve un array con 1 elemento con el indice "max fecha"
    $max_fecha = $resultado['max_fecha'];//sacamos el valor de "max_fecha"

    $stmt4 = $conn->prepare("UPDATE emple_depart SET fecha_fin = :fecha_fin 
                            WHERE fecha_ini = :max_fecha
                            AND dni = :dni ");
    $stmt4->bindParam(':fecha_fin',$fecha_fin);
    $stmt4->bindParam(':max_fecha',$max_fecha);
    $stmt4->bindParam(':dni',$dni);
    $stmt4->execute();

    //relacion del empleado con el cod_dpto está en tabla trabaja
    //Trabahjamos con la table trabaja!! 
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
