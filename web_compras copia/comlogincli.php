<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body{
            margin-left: 40%;
            padding-top: 5%;
            font-size: 20px;
        }
    </style>
    <title>LogIn</title>
</head>
<body>
<h2>Log In</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <label>Usuario: 
        <input type="text" name="usuario">
    </label><br>

    <label>Contraseña: 
        <input type="text" name="contrasenia">
    </label><br>

    <input type="submit">

</form>
    
</body>
</html>

<?php
//https://stackoverflow.com/questions/27183416/what-exactly-does-the-php-function-test-input-do
if ($_SERVER["REQUEST_METHOD"]=="POST") {
    try {
        require_once 'funciones.php';

        $conn = conexion();
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $usuario = limpieza_trim($_POST["usuario"]);
        $contrasenia = limpieza_trim($_POST["contrasenia"]);

        $smtm = $conn->prepare("SELECT COUNT(*) FROM USUARIOS WHERE USUARIO = :USUARIO AND CONTRASENIA = :CONTRASENIA");
        $smtm -> bindParam(':USUARIO',$usuario);
        $smtm -> bindParam(':CONTRASENIA',$contrasenia);
        $smtm -> execute();
        $resultado = $smtm->fetch(PDO::FETCH_ASSOC);
        $count_fila = $resultado["COUNT(*)"];

        echo "count_fila: " . $count_fila . "<br>";

        if ($count_fila>0) {
            echo "correcto";
            header("Location: portalcli.php");
        }else{
            echo "Usuario o contraseña mal escrito";
        }


    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }

}
?>