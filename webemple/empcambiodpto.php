<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Cambio de departamento </h2>
    
    <?php
        $servername = "localhost";
        $username = "root";
        $password = "rootroot";
        $dbname = "webemple";
     
         
     try {
         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         //Mostrar la lista de empleados
         $stmt = $conn->prepare("SELECT dni,nombre,apellidos FROM empleado");
         $stmt->execute(); //excute
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         $list_dni = $stmt->fetchAll();
      
        
         echo "<label for='dni'>Selecciona empleado:</label>";
         echo "<select name='dni_seleccionado' id='dni'>";
         foreach($list_dni as $row) { 

             echo "<option value= " . $row["dni"]. ">" . $row["nombre"] . " " .  $row["apellidos"] . "</option>";
            //selecciona dni (valor de value) pero muestra el nombre y los apellidos
         }
         echo "</select>" . "<br>"; 
     
         //Mostrar lista de departamentos
         $stmt2 = $conn->prepare("SELECT cod_dpto,nombre_dpto FROM departamento");
         $stmt2->execute(); //excute
         $stmt2->setFetchMode(PDO::FETCH_ASSOC);
         $list_cod = $stmt2->fetchAll();
      
         echo "<label for='dpto'>Selecciona a qué departamente se va a trasladar:</label>";
         echo "<select name='dpto_seleccionado' id='dpto'>";
         foreach($list_cod as $row) { 
     
             echo "<option value= " . $row["cod_dpto"]. ">" . $row["nombre_dpto"] . "</option>";
            //selecciona codigo pero muestra el nombre
         }
         echo "</select>" . "<br>"; 

        
        
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
    $dni = $_POST["dni_seleccionado"];
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
    $stmt5 = $conn->prepare("UPDATE emple_depart SET salario = :salario VALUES (:dni,:dpto_seleccionado,:fecha_ini) ");
    $stmt5->bindParam(':dni',$dni); //seguridad, evitar inyección
    $stmt5->bindParam(':dpto_seleccionado', $dpto_seleccionado);
    $stmt5->bindParam(':fecha_ini', $fecha_ini);
 
    $stmt5->execute();


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
