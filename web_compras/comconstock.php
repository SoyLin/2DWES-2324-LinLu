<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
  
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Consulta de cantidad</h2>
 
        <?php
        require_once 'funciones.php';

         
     try {
         $conn = conexion();
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
    // MOSTRAR LISTA DE PRODUCTO
    $table_list ="producto";
    $ID_campo_list ="ID_PRODUCTO";
    $Otros_campos = "NOMBRE";
    $mensaje = "Selecciona producto";
    $name_indice = "indice_pro";
    list_cat($conn,$ID_campo_list,$Otros_campos,$table_list,$mensaje,$name_indice);//imprimir lista pasando parámetros

    ?>

        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar
 
    //*1 sacar el valor seleccionado de producto
    $ID_PRODUCTO = $_POST[$name_indice];

    $stmt1 = $conn->prepare("SELECT NOMBRE,CANTIDAD,LOCALIDAD FROM producto,almacena,almacen 
                            WHERE producto.ID_PRODUCTO = almacena.ID_PRODUCTO 
                            AND almacena.NUM_ALMACEN=almacen.NUM_ALMACEN
                            AND  producto.ID_PRODUCTO = :ID_PRODUCTO"); //*1 el ID_PRODUCTO seleccionado por el usuario

    $stmt1->bindParam(':ID_PRODUCTO',$ID_PRODUCTO); //seguridad

    $stmt1->execute(); //excute
    $stmt1->setFetchMode(PDO::FETCH_ASSOC);
    $resultado = $stmt1->fetchAll();
 
    echo "New records created successfully" . "<br>";
    echo "<pre>";
    print_r($resultado);
    echo "</pre>";

    echo "<br><table>";
    echo "<tr> <td>PRODUCTO</td> <td>CANTIDAD</td> <td>LOCALIDAD</td></tr>";

    foreach($resultado as $aray) {
        echo "<tr>";
        echo "<td>" . $aray["NOMBRE"] . "</td>";     //imprimir valor correspondiente del índice "NOMBRE"
        echo "<td>" . $aray["CANTIDAD"] . "</td>";   //imprimir valor correspondiente del índice "CANTIDAD"
        echo "<td>" . $aray["LOCALIDAD"] . "</td>";  //imprimir valor correspondiente del índice "LOCALIDAD"
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
