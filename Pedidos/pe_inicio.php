<?php
session_start(); 

if(!isset($_SESSION["usuario"])) {
    echo "Sesion no definida";
    header("Location: pe_login.php");
} else {
    
?>
<!DOCTYPE html>
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
    <div>
        <div class="menu" id="compra">
            <a href="./pe_altaped.php">1.COMPRA DE PRODUCTOS</a>
        </div>
        <!-- <div class="menu" id="consulta">
            <a href="./comconscli.php">2.CONSULTA DE COMPRAS</a>
        </div> -->
    </div>
    <br><a href="pe_logout.php">Cerrar Sesión</a>
</body>
</html>
<?php

}
?>