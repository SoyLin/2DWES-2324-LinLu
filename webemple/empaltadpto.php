<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    require_once('./funciones.php');
    
try {
    //establecer conexión
    $conn = conexion();
    
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //SACAR MAX ID
    $max_cod = max_codigo($conn);
    

    $nombre_dpto = $_POST["nombre_dpto"]; //sacar dato introducido por usuario
    $letra = "D"; //Letra inicial del código
    $cod_dpto =  incremento($max_cod,$letra);
    echo $cod_dpto;

    //insertar en la tabla departamento
    insert_dpto($conn,$cod_dpto,$nombre_dpto);

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 
}
    
?>
