<?php
echo "Inicio controller"."<br>";
require_once("views/view.php");

if ($_SERVER["REQUEST_METHOD"]=="POST") {

$usuario = $_POST["usuario"];
$contrasenia =$_POST["contrasenia"];



//Llamada al modelo -- Intermediario entre vista y modelo !!!
require_once("models/model.php");

$count_fila = filaDevuelto($usuario,$contrasenia);


if ($count_fila !=0) {
    session_start();
    $_SESSION["usuario"] = $usuario;
    header("Location: pe_inicio.php");
    exit();
}else {
    echo "Usuario o contraseña mal escrito";
    
}
}

//Llamada a la vista -- Intermediario entre vista y modelo !!!
echo "Fin controller"."<br>";
?>