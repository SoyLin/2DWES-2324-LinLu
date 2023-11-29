<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Alta empleados</h2>
        <label for="dni">Introduce el DNI </label>
        <input type="text" id="dni" name="dni"><br>

      
        <label for="cod">Código departamento</label>
        <input type="text" id="cod" name="cod_dpto"><br>

        <label for="fecha_ini">Fecha inicio</label>
        <input type="text" id="fecha_ini" name="fecha_ini"><br>

        <input type="submit">
    </form>
</body>
</html>
<?php
    $servername = "localhost:8889";
    $username = "root";
    $password = "root";
    $dbname = "empleadosnn";
    
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // tabla empleado
    $stmt = $conn->prepare("INSERT INTO emple_dpto (dni,cod_dpto,fecha_ini) VALUES (:dni,:cod_dpto,:fecha_ini)");
    $stmt->bindParam(':dni',$dni);
   
    $stmt->bindParam(':cod_dpto', $cod_dpto);
    $stmt->bindParam(':fecha_ini', $fecha_ini);

    
    $dni = $_POST["dni"];
    $cod_dpto = $_POST["cod_dpto"];
    $fecha_ini = $_POST["fecha_ini"];

    $stmt->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 
    
?>
