<?php
session_start(); //recuperar phpsesionID

if(!isset($_SESSION["usuario"])) { //comprobar si ha pasado por login
    echo "Sesion no definida";  //si NO está establecida la variable -> no ha pasado por login -> es una copia de enlace
    header("Location: pe_login.php"); //DEBE loguearse primero
} else {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>COMPRAS</title>
</head>
<body>
<a href="./portalcli.php">Volver al menú</a>
<h2>Compra de productos</h2>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<?php
        require_once 'funciones.php';

     try {
        $conn = conexion();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $stmt = $conn->prepare("SELECT products.productCode,productName FROM products WHERE quantityInStock >0");
        $stmt->execute(); //excute
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $multi_fila = $stmt->fetchAll();

        // echo "<pre>";
        // print_r($multi_fila);
        // echo "</pre>";  
            
        echo "<label for='pro'> Selecciona producto</label>";
         
        echo "<select name='pro_seleccionado' id='pro'>";
        foreach($multi_fila as $aray) { 
         
            echo "<option value= " . $aray["productCode"]. ">" . $aray["productName"] . "</option>";
        //selecciona codigo pero muestra el nombre
        }
        echo "</select>" . "<br>"; 
        
       
   
?>
    <br><label>Cantidad:
        <input type="text" name="cantidad">
    </label><br>
    <br><input type="submit" value="añadir carrito" formaction="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>">
    <input type="submit" value="finalizar compra" formaction="pe_finaliza.php">
</form>
    <br><a href="pe_logout.php">Cerrar Sesión</a>
</body>
</html>

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" ) {
    // unset($_SESSION["carrito"]); destruir un valor especifico de session


    $pro_seleccionado = $_POST["pro_seleccionado"];
    $cantidad = $_POST["cantidad"];

   
  
    if(empty($_SESSION["carrito"])) {
        $carrito_aray = array(
            array("productCode" => $pro_seleccionado, "cantidad" => $cantidad),
        );
        $_SESSION["carrito"] = $carrito_aray;

    }else {
        $_SESSION['carrito'][]=array("productCode"=>$pro_seleccionado, "cantidad"=> $cantidad);
     
    }
 

    echo "<pre>";
    print_r( $_SESSION);
    echo "</pre>";
    

}
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
}
 
}
?>
