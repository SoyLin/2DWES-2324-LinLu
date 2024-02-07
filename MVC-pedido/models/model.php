<?php
echo "Inicio modelo"."<br>";


function filaDevuelto($usuario,$contrasenia){
	global $conn;

	try {
		$smtm = $conn->prepare("SELECT COUNT(*) FROM customers WHERE customerNumber  = :usuario AND contactLastName = :contrasenia");
    	$smtm -> bindParam(':usuario',$usuario);
   		$smtm -> bindParam(':contrasenia',$contrasenia);
    	$smtm -> execute();
    	$resultado = $smtm->fetch(PDO::FETCH_ASSOC);
    	$count_fila = $resultado["COUNT(*)"];
		echo "countfila:" . $count_fila;
		return $count_fila;
	} catch (PDOException $ex) {
		echo "Error al recuperar peliculas". $ex->getMessage();
		return null;
	}
}

echo "Fin modelo"."<br>";
?>