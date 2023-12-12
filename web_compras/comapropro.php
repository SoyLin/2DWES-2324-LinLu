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
 
        <?php
         $servername = "localhost";
         $username = "root";
         $password = "rootroot";
         $dbname = "comprasweb";
     
         
     try {
         $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    // MOSTRAR LISTA DE PRODUCTO
         $stmt = $conn->prepare("SELECT ID_PRODUCTO,NOMBRE FROM producto");
         $stmt->execute(); //excute
         $stmt->setFetchMode(PDO::FETCH_ASSOC);
         $list_pro = $stmt->fetchAll();
      
        
         echo "<label for='pro'>Selecciona producto:</label>";
     
         echo "<select name='PRO' id='pro'>";
         foreach($list_pro as $row) { 
     
            echo "<option value= " . $row["ID_PRODUCTO"]. ">" . $row["NOMBRE"] . "</option>";
            //muestra "NOMBRE" pero selecciona "ID_PRODUCTO" , porque es el valor que se almacena en value 
         }
         echo "</select>" . "<br>"; 


    // MOSTRAR LISTA DE ALMACEN
         $stmt1 = $conn->prepare("SELECT NUM_ALMACEN,LOCALIDAD FROM almacen");
         $stmt1->execute(); //excute
         $stmt1->setFetchMode(PDO::FETCH_ASSOC);
         $list_alm = $stmt1->fetchAll();
      
        
         echo "<label for='alm'>Selecciona almacén:</label>";
     
         echo "<select name='ALMACEN' id='alm'>";
         foreach($list_alm as $row) { 
     
            echo "<option value= " . $row["NUM_ALMACEN"]. ">" . $row["LOCALIDAD"] . "</option>";
            //muestra "LOCALIDAD" pero selecciona "NUM_ALMACEN" , porque es el valor que se almacena en value 
         }
         echo "</select>" . "<br>"; 

    
        ?>
        <!--input para introducir datos por usuario-->
        <label>Introduce la cantidad del producto seleccionado
        <input type="text" name="CANTIDAD"> </label><br>

        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar
   
    //sacar los valores
    $ID_PRODUCTO = $_POST["PRO"];
    $NUM_ALMACEN = $_POST["ALMACEN"];
    $CANTIDAD = $_POST["CANTIDAD"];
  
      
    $stmt2 = $conn->prepare("INSERT INTO almacena (ID_PRODUCTO,NUM_ALMACEN,CANTIDAD) VALUES (:ID_PRODUCTO,:NUM_ALMACEN,:CANTIDAD)");
    $stmt2->bindParam(':ID_PRODUCTO',$ID_PRODUCTO);
    $stmt2->bindParam(':NUM_ALMACEN', $NUM_ALMACEN);
    $stmt2->bindParam(':CANTIDAD',$CANTIDAD);


    $stmt2->execute();


    echo "New records created successfully";
    }
    }
    
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 


    
?>
