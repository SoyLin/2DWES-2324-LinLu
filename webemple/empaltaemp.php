<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
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

    //almacenar datos introducidos por el usuario (cogemos las informaciones introducidos por el usuario y las almacenas en una variable)
    $dni = $_POST["dni"];
    $nombre_emple = $_POST["nombre_emple"];
    $apellido = $_POST["apellido"];
    $fecha_nac = $_POST["fecha_nac"];
    $salario = $_POST["salario"];
    $fecha_ini = $_POST["fecha_ini"];
  
    //almacena el codigo de departamento en tabla trabaja (relación N:N)
    $dpto_seleccionado = $_POST["dpto_seleccionado"];

    //Insertar en table empleado!!              //estos son los campos de la tabla empleado       //esto son los valores introducido por usuario (en formato seguro y no directamente hacer con las variables)
    $stmt2 = $conn->prepare("INSERT INTO empleado (dni,nombre,apellidos,fecha_nac,salario) VALUES (:dni,:nombre_emple,:apellido,:fecha_nac,:salario)");
    $stmt2->bindParam(':dni',$dni); //seguridad, evitar inyección
    $stmt2->bindParam(':nombre_emple', $nombre_emple);
    $stmt2->bindParam(':apellido',$apellido);
    $stmt2->bindParam(':fecha_nac',$fecha_nac);
    $stmt2->bindParam(':salario', $salario);
    $stmt2->execute();

    //cod_dpto se almacena en tabla trabaja, junto con algunos otros datos introducidos por usuario
    //Insertar en table trabaja!!              //estos son los campos de la tabla trabaja       //esto son los valores introducido por usuario (en formato seguro y no directamente hacer con las variables)
    $stmt3 = $conn->prepare("INSERT INTO emple_depart (dni,cod_dpto,fecha_ini,fecha_fin) VALUES (:dni,:dpto_seleccionado,:fecha_ini,:fecha_fin)");
    $stmt3->bindParam(':dni',$dni); //seguridad, evitar inyección
    $stmt3->bindParam(':dpto_seleccionado', $dpto_seleccionado);
    $stmt3->bindParam(':fecha_ini',$fecha_ini);
    $stmt3->bindParam(':fecha_fin',$fecha_fin);

    $stmt3->execute();


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
