<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Alta de productos</h2>
        <label>Introduce nombre de producto    
        <input type="text" name="NOMBRE"> </label><br>

        <label>Introduce el precio de producto    
        <input type="text" name="PRECIO"> </label><br>
        <?php
         $servername = "localhost";
         $username = "root";
         $password = "rootroot";
         $dbname = "comprasweb";
     
     
     
         
     try {
         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
     
         $stmt2 = $conn->prepare("SELECT ID_CATEGORIA,NOMBRE FROM categoria");
         $stmt2->execute(); //excute
         $stmt2->setFetchMode(PDO::FETCH_ASSOC);
         $list_cat = $stmt2->fetchAll();
      
        
         echo "<label for='cat'>Selecciona categoria:</label>";
     
         echo "<select name='cat' id='cat'>";
         foreach($list_cat as $row) { 
     
             echo "<option value= " . $row["ID_CATEGORIA"]. ">" . $row["NOMBRE"] . "</option>";
     
         }
         echo "</select>" . "<br>"; 

        
     
     
        
        ?>

        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar
    //SACAR MAX ID
    $stmt3 = $conn->prepare("SELECT MAX(ID_PRODUCTO	)as max_id FROM producto");
    $stmt3->execute(); //excute
    $sql_id = $stmt3 -> fetch(PDO::FETCH_ASSOC); //devuelve un array
    $max_id = $sql_id['max_id']; //sacar el valor de la posición "max_id"
  


    $NOMBRE = $_POST["NOMBRE"];
    $PRECIO = $_POST["PRECIO"];
    $ID_CATEGORIA = $_POST["cat"];

    $ID_PRODUCTO =  incremento($max_id);
    //echo $ID_PRODUCTO;
      
    $stmt = $conn->prepare("INSERT INTO producto (ID_PRODUCTO,NOMBRE,PRECIO,ID_CATEGORIA) VALUES (:ID_PRODUCTO,:NOMBRE,:PRECIO,:ID_CATEGORIA)");
    $stmt->bindParam(':ID_PRODUCTO',$ID_PRODUCTO);
    $stmt->bindParam(':NOMBRE', $NOMBRE);
    $stmt->bindParam(':ID_CATEGORIA',$ID_CATEGORIA);
    $stmt->bindParam(':PRECIO', $PRECIO);

    $stmt->execute();


    echo "New records created successfully";
    }
    }
    
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 
function incremento($numero){
    $numero = substr($numero,1);
    if ($numero==0) {
        $numero=0;
    }
    $numero++;
    $numero = str_pad($numero,3,"0",STR_PAD_LEFT);
    return "P" . $numero;
}


    
?>
