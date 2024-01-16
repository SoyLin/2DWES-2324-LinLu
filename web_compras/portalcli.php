<!DOCTYPE html>
<?php
session_start(); 

if(!isset($_SESSION["usuario"])) {
    echo "Sesion no definida";
    header("Location: comlogincli.php");
} else {
    
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            margin-left: 40%;
            padding-top: 5%;
            font-size:20px;
        }
        div{
            padding-top: 1.5%;
        }
        a:visited{
            color: blueviolet;
        }
    </style>
    <title>Document</title>
</head>
<body>
<h3>MENÚ</h3>
    <div id="">
        <div class="menu" id="compra">
            <a href="./comprocli.php">1.COMPRA DE PRODUCTOS</a>
        </div>
        <div class="menu" id="consulta">
            <a href="./comconscli.php">2.CONSULTA DE COMPRAS</a>
        </div>
    </div>
    <a href="cerrar.php">Cerrar Sesión</a>
    <!-- <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
        <input type="submit" name="cerrar" value="Cerrar sesion"/>
    </form> -->
    <?php
    // if (($_SERVER["REQUEST_METHOD"]=="POST")&&()) {
    //     session_unset();
    //     session_destroy();
    //     set_cookie("PHPSESSID","",time()-3600,"/");
       
    //     header("Location: comlogincli.php");
    // }
    ?>

</body>
</html>
<?php

}
?>