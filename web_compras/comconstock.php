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
        //IMPORTANTE!! value = ID_PRODUCTO , nos envia el ID_PRODUCTO y no el nombre
         }
         echo "</select>" . "<br>"; 

        ?>

        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar
 
    //*1 sacar el valor seleccionado de producto
    $ID_PRODUCTO = $_POST["PRO"];

    $stmt1 = $conn->prepare("SELECT NOMBRE,CANTIDAD,LOCALIDAD FROM producto,almacena,almacen 
                            WHERE producto.ID_PRODUCTO = almacena.ID_PRODUCTO 
                            AND almacena.NUM_ALMACEN=almacen.NUM_ALMACEN
                            AND  producto.ID_PRODUCTO = :ID_PRODUCTO"); //*1 el ID_PRODUCTO seleccionado por el usuario

    $stmt1->bindParam(':ID_PRODUCTO',$ID_PRODUCTO); //seguridad

    $stmt1->execute(); //excute
    $stmt1->setFetchMode(PDO::FETCH_ASSOC);
    $resultado = $stmt1->fetchAll();
 
    echo "New records created successfully" . "<br>";


    echo "<br><table>";
    echo "<tr> <td>PRODUCTO</td> <td>CANTIDAD</td> <td>LOCALIDAD</td></tr>";

    foreach($resultado as $row) {
        echo "<tr>";
        echo "<td>" . $row["NOMBRE"] . "</td>";     //imprimir valor correspondiente del índice "NOMBRE"
        echo "<td>" . $row["CANTIDAD"] . "</td>";   //imprimir valor correspondiente del índice "CANTIDAD"
        echo "<td>" . $row["LOCALIDAD"] . "</td>";  //imprimir valor correspondiente del índice "LOCALIDAD"
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
