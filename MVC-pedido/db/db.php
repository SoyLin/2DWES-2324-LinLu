<?php
echo "Inicio db.php"."<br>";

    $servername = "localhost";
    $username = "root";
    $password = "rootroot";
    $dbname = "pedidos";//nombre de bases de datos, escribir el nombre correcto para conectar con el BBDD correspondiente

	try {
   		$conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION); 	 	 	 	 	 	
	} catch (PDOException $ex) {
		echo $ex->getMessage(); 	 	 	 	 	 	
	}
	
echo "finaliza db.php"."<br>";
?>