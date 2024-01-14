<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Alta de almacén</h2>
        <label>Introduce la localidad del almacén 
        <input type="text" name="LOCALIDAD"> </label><br>

        <input type="submit">
    </form>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar

require_once 'funciones.php';
    
try {

    $conn = conexion();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //SACAR MAX ID
    $table = "almacen";
    $ID_campo = "NUM_ALMACEN";
    $max_id = max_codigo ($conn,$ID_campo,$table);
   


    $LOCALIDAD = $_POST["LOCALIDAD"];

    $NUM_ALMACEN = $max_id;
    if ($NUM_ALMACEN==0) {
        $NUM_ALMACEN=0;
    }
    $NUM_ALMACEN++;
   
    echo $NUM_ALMACEN;
      
    $stmt = $conn->prepare("INSERT INTO almacen (NUM_ALMACEN,LOCALIDAD) VALUES (:NUM_ALMACEN,:LOCALIDAD)");
    $stmt->bindParam(':NUM_ALMACEN',$NUM_ALMACEN);
    $stmt->bindParam(':LOCALIDAD', $LOCALIDAD);

    $stmt->execute();


    echo "New records created successfully";
    }
    
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 
}
    
?>
