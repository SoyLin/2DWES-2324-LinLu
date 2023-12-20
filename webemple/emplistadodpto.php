<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Listado de empleados</h2>
     
        <?php
         $servername = "localhost";
         $username = "root";
         $password = "rootroot";
         $dbname = "webemple";
     
         
     try {
         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
     
         $stmt = $conn->prepare("SELECT cod_dpto,nombre_dpto FROM departamento");
         $stmt->execute(); //excute
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         $list_cat = $stmt->fetchAll();
      
        
         echo "<label for='dpto'>Selecciona departamento:</label>";
     
         echo "<select name='dpto_seleccionado' id='dpto'>";
         foreach($list_cat as $row) { 
     
             echo "<option value= " . $row["cod_dpto"]. ">" . $row["nombre_dpto"] . "</option>";
            //selecciona codigo pero muestra el nombre
         }
         echo "</select>" . "<br>"; 

        
        
        ?>

        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar

    //almacena el codigo de departamento en tabla trabaja (relación N:N)
    $dpto_seleccionado = $_POST["dpto_seleccionado"];

    //Insertar en table empleado!!              //estos son los campos de la tabla empleado       //esto son los valores introducido por usuario (en formato seguro y no directamente hacer con las variables)
    $stmt2 = $conn->prepare("SELECT emple_depart.dni, CONCAT (nombre,' ',apellidos) AS NomApe, fecha_ini FROM empleado,emple_depart  
                            WHERE emple_depart.dni = empleado.dni
                            AND cod_dpto = :cod_dpto
                            AND fecha_fin IS NULL ");
    $stmt2->bindParam(':cod_dpto',$dpto_seleccionado); //seguridad, evitar inyección
    $stmt2->execute();
    $stmt2->setFetchMode(PDO::FETCH_ASSOC);
    $resultado = $stmt2->fetchAll();
 
    echo "New records created successfully" . "<br>";


    echo "<br><table>";
    echo "<tr> <td>DNI</td> <td>Nombre</td><td>fecha de inicio</td></tr>";

    foreach($resultado as $row) {
        echo "<tr>";
        echo "<td>" . $row["dni"] . "</td>";     //imprimir valor correspondiente del índice "dni"
        echo "<td>" . $row["NomApe"] . "</td>";   //imprimir valor correspondiente del índice "NomApe"
        echo "<td>" . $row["fecha_ini"] . "</td>";  //imprimir valor correspondiente del índice "fecha_ini"
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
