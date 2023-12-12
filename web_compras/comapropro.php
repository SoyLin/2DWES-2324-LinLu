<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Alta de cantidad (Tabla almacena)</h2>
 
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

    $stmt2 = $conn->prepare("SELECT CANTIDAD FROM almacena 
                            WHERE ID_PRODUCTO= :ID_PRODUCTO
                            AND NUM_ALMACEN= :NUM_ALMACEN");
    
    $stmt2->bindParam(':ID_PRODUCTO',$ID_PRODUCTO); //seguridad
    $stmt2->bindParam(':NUM_ALMACEN', $NUM_ALMACEN);

    $stmt2->execute(); //excute
    $resultado = $stmt2 -> fetch(PDO::FETCH_ASSOC); //devuelve un array
    $historia_cant = $resultado['CANTIDAD']; //sacar el valor de la posición "CANTIDAD"
   
    //echo "cantidad que tenía " . $historia_cant . "<br>";

    if ($historia_cant==0) {
        $stmt3 = $conn->prepare("INSERT INTO almacena (ID_PRODUCTO,NUM_ALMACEN,CANTIDAD) VALUES (:ID_PRODUCTO,:NUM_ALMACEN,:CANTIDAD)");
        $stmt3->bindParam(':ID_PRODUCTO',$ID_PRODUCTO);
        $stmt3->bindParam(':NUM_ALMACEN', $NUM_ALMACEN);
        $stmt3->bindParam(':CANTIDAD',$CANTIDAD);
        $stmt3->execute();
    
    }else{
        $CANTIDAD += $historia_cant;
        $stmt4 = $conn->prepare("UPDATE almacena SET CANTIDAD = :CANTIDAD
                                WHERE ID_PRODUCTO = :ID_PRODUCTO
                                AND NUM_ALMACEN = :NUM_ALMACEN");
        $stmt4->bindParam(':ID_PRODUCTO',$ID_PRODUCTO);
        $stmt4->bindParam(':NUM_ALMACEN', $NUM_ALMACEN);
        $stmt4->bindParam(':CANTIDAD',$CANTIDAD);
        $stmt4->execute();

    }



   


    echo "New records created successfully";
    }
    }
    
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 


    
?>
