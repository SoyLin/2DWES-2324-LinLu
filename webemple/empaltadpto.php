<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "webemple";
    
    require_once 'funciones.php';
    
try {
    //establecer conexión
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //SACAR MAX ID
    $stmt = $conn->prepare("SELECT MAX(cod_dpto)as max_cod FROM departamento");
    $stmt->execute(); //excute
    $sql_cod = $stmt -> fetch(PDO::FETCH_ASSOC); //devuelve un array
    $max_cod = $sql_cod['max_cod']; //sacar el valor de la posición "max_cod"
       
    
    //echo "<pre>";
    //print_r($sql_cod);
    
    //echo "</pre>";

    $nombre_dpto = $_POST["nombre_dpto"]; //sacar dato introducido por usuario
    $letra = "D"; //Letra unucial del código
    $cod_dpto =  incremento($max_cod,$letra);
    echo $cod_dpto;

    $stmt2 = $conn->prepare("INSERT INTO departamento (cod_dpto,nombre_dpto) VALUES (:cod_dpto,:nombre_dpto)");
    $stmt2->bindParam(':cod_dpto', $cod_dpto);
    $stmt2->bindParam(':nombre_dpto', $nombre_dpto);
  
 
    $stmt2->execute();

    echo "New records created successfully";
    }
catch(PDOException $e)
    {
    echo "Error: " . $e->getMessage();
    }
$conn = null; 
}
    
?>
