<?php
session_start(); 

if(!isset($_SESSION["usuario"])) {
    echo "Sesion no definida";
    header("Location: comlogincli.php");
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

        

        <input type="submit">
    </form>
    <br><a href="cerrar.php">Cerrar Sesión</a>
</body>
</html>

<?php

}
?>
