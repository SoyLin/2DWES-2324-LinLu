<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
 
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Alta de cliente</h2>
        <label>Introduce el NIF    
        <input type="text" name="NIF"> </label><br>

        <label>Introduce el nombre
            <input type="text" name="nom_cliente">
        </label><br>

        <label>Introduce los apellidos
            <input type="text" name="ape_cliente">
        </label><br>

        <label>Introduce el código postal
            <input type="text" name="cp">
        </label><br>

        <label>Introduce la dirección
            <input type="text" name="direccion">
        </label><br>

        <label>Introduce la ciudad
            <input type="text" name="ciudad_cliente">
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

        if (empty($_POST["NIF"])) { //comprueba si el input está vacía
            echo "NIF es un campo obligatorio";
    
        }else { // si no es vacía
            $NIF = limpieza($_POST["NIF"]); //recupera el dato y lo pasa por la funcion limpieza
            if (!preg_match("/^[0-9]{8}[A-Za-z]$/",$NIF)) { //comprueba si cumple el formato
                echo "NIF debe componer de 8 dígitos + 1 letra";
            }else{//formato válido
                $conn = conexion();
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            
                //recuperar datos introducidos por el usuario
              
                $nom_cliente = $_POST["nom_cliente"];
                $ape_cliente = $_POST["ape_cliente"];
                $CP = $_POST["CP"];
                $direccion = $_POST["direccion"];
                $ciudad = $_POST["ciudad_cliente"];
        
                //la conexión había almacenado en $conn, a través de esta conexión realizamos la consulta preparada
                //comprueba en BBDD si existe algún resgistro NIF con el mismo valor    
                $stmt = $conn->prepare("SELECT COUNT(NIF) FROM CLIENTE WHERE NIF = :NIF");
                $stmt -> bindParam(':NIF',$NIF);
                $stmt -> execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                $count_nif = $resultado["COUNT(NIF)"];
                echo "count(nif): " . $count_nif . "<br>";
        
                // si $count_nif es MAYOR que 0 -> significa que AL MENOS EXISTE 1 FILA QUE CUMPLE CON LA CONDICIÓN
                //si NIF no existía -> no devuelve ninguna fila -> count = 0
                if ($count_nif>0) {
                    echo "NIF repetido: ya existe un cliente con el mismo NIF";
                }else{
                    $stmt2 = $conn->prepare("INSERT INTO CLIENTE (NIF,NOMBRE,APELLIDO,CP,DIRECCION,CIUDAD) VALUES (:NIF,:NOMBRE,:APELLIDO,:CP,:DIRECCION,:CIUDAD)");
                    $stmt2 -> bindParam(':NIF',$NIF);
                    $stmt2 -> bindParam(':NOMBRE',$nom_cliente);
                    $stmt2 -> bindParam(':APELLIDO',$ape_cliente);
                    $stmt2 -> bindParam(':CP',$CP);
                    $stmt2 -> bindParam('DIRECCION',$direccion);
                    $stmt2 -> bindParam(':CIUDAD',$ciudad);
        
                    $stmt2 -> execute();
                    echo "New records created successfully";
                }
            }
        }

       
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
   
}

?>