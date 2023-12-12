<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Alta de almacen</h2>
        <label>Introduce la LOCALIDADd de almacén 
        <input type="text" name="LOCALIDAD"> </label><br>

        <input type="submit">
    </form>
</body>
</html>
<?php
    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";


if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar
    
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //SACAR MAX ID
    $stmt2 = $conn->prepare("SELECT MAX(NUM_ALMACEN)as max_id FROM almacen");
    $stmt2->execute(); //excute
    $sql_id = $stmt2 -> fetch(PDO::FETCH_ASSOC); //devuelve un array
    $max_id = $sql_id['max_id']; //sacar el valor de la posición "max_id"
   

    echo "<pre>";
    print_r($sql_id);

   echo "</pre>";


    $LOCALIDAD = $_POST["LOCALIDAD"];
    
    $NUM_ALMACEN =  incremento($max_id);
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

function incremento($numero){
    if ($numero==0) {
        $numero=0;
    }
    $numero++;
    
    return $numero;
}
    
?>
