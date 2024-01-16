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
//https://www.php.net/manual/en/function.require.php 
        require_once 'funciones.php';
      
     try {
         $conn = conexion();
         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

         $table_list ="categoria";
         $ID_campo_list ="ID_CATEGORIA";
         $Otros_campos = "NOMBRE";
         $mensaje = "Selecciona categoria";
         $name_indice = "list_select";
         list_cat($conn,$ID_campo_list,$Otros_campos,$table_list,$mensaje,$name_list);//imprimir lista
        
        //  echo "<pre>";
        //  print_r($list_cat);
        //  echo "</pre>";
        //  foreach ($list_cat as $value) {
        //     //con foreach accede a las arrays secundarias
        //     //dentro del array indicamos el INDICE ["ID_CATEGORIA"] para sacar el elemento/valor correspondiente
        //     echo  $value["ID_CATEGORIA"] . "<br>"; 
           
        //  }
        
        ?>

        <input type="submit">
    </form>
</body>
</html>
<?php
   if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar
    //SACAR MAX ID
    $table="producto";
    $ID_campo="ID_PRODUCTO";
    $max_id = max_codigo($conn,$ID_campo,$table);
  


    $NOMBRE = $_POST["NOMBRE"];
    $PRECIO = $_POST["PRECIO"];
    $ID_CATEGORIA = $_POST["list_select"];

    $letra = "P";
    $ID_PRODUCTO =  incremento($max_id,$letra);
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


    
?>
