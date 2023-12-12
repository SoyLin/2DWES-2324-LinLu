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
    require_once 'funciones.php';

    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "comprasweb";


if ($_SERVER["REQUEST_METHOD"] == "POST") { //primero enviar, depués ejecutar
    
try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //SACAR MAX ID
    $stmt2 = $conn->prepare("SELECT MAX(ID_CATEGORIA)as max_id FROM categoria");
    $stmt2->execute(); //excute
    $sql_id = $stmt2 -> fetch(PDO::FETCH_ASSOC); //devuelve un array
    $max_id = $sql_id['max_id']; //sacar el valor de la posición "max_id"
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $resultado=$stmt->fetchAll();

    echo "<pre>";
    print_r($sql_id);

   echo "</pre>";


        $NOMBRE = $_POST["NOMBRE"];
        $letra = "C";
        $ID_CATEGORIA =  incremento($max_id,$letra);
       // echo $ID_CATEGORIA;
      
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
