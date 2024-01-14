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
 
 
     // MOSTRAR LISTA DE ALMACEN
     $table_list2 ="almacen";
     $ID_campo_list2 ="NUM_ALMACEN";
     $Otros_campos2 = "LOCALIDAD";
     $mensaje2 = "Selecciona almacén";
     $name_indice2 = "indice_alm";
     list_cat($conn,$ID_campo_list2,$Otros_campos2,$table_list2,$mensaje2,$name_indice2);
     
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
    $ID_PRODUCTO = $_POST[$name_indice];
    $NUM_ALMACEN = $_POST[$name_indice2];
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
