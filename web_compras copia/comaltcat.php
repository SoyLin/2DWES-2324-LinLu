<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Alta de categorías</h2>
        <label>Introduce nombre de categoria    
        <input type="text" name="NOMBRE"> </label><br>

        <input type="submit">
    </form>
</body>
</html>
<?php
//he descubierto que hay que incluir el fichero antes de utilizar la funcion del dentro
// si lo incluimos al final -> cuando llamamos a la funcion -> undefined function 

if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar
    
    
try {
    require_once 'funciones.php';

    $conn = conexion();
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //SACAR MAX ID
    $table="categoria";
    $ID_campo="ID_CATEGORIA";
    $max_id = max_codigo($conn,$ID_campo,$table); //llamar la función para sacar el max_id, pasando el parametro de $conn
 
    //recuperar valor
    $NOMBRE = $_POST["NOMBRE"];
    $letra = "C";
    $ID_CATEGORIA =  incremento($max_id,$letra); //funcion para crear un nuevo id con la letra que le asignamos
    //echo $ID_CATEGORIA;
      
    $stmt = $conn->prepare("INSERT INTO categoria (ID_CATEGORIA,NOMBRE) VALUES (:ID_CATEGORIA,:NOMBRE)");
    $stmt->bindParam(':ID_CATEGORIA',$ID_CATEGORIA);
    $stmt->bindParam(':NOMBRE', $NOMBRE);
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
