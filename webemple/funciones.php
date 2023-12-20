<?php
//PDO
function conexion($dbname){
    $conn = new PDO("mysql:host=localhost;dbname=$dbname", "root", "rootroot");
    return $conn;
}

function lista_empleado($conn){
    $stmt = $conn->prepare("SELECT dni, CONCAT (nombre,' ',apellidos) AS NomApe,salario FROM empleado");
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $list_emp = $stmt->fetchAll();
    return $list_emp;
}


// INCREMENTO DE CÓDIGO
function incremento($numero,$letra){
    $numero = substr($numero,1);
    if ($numero==0) {
        $numero=0;
    }
    $numero++;
    $numero = str_pad($numero,3,"0",STR_PAD_LEFT);
    return $letra . $numero;
}

//CALCULO PORCENTAJE
// $numero = "-200%";
// $salario = 1000;
// $numero=porcentaje($numero);
// echo $numero . "<br>";
// echo "salario: " .($salario + ($salario*$numero));

function porcentaje ($porcen){

    $fraccion_decimal = strtok($porcen,"%");
    $fraccion_decimal /=100;

    return $fraccion_decimal;

}







?>


<!-- https://github.com/Franyxy/2DWES-AndresGarcia/blob/main/Ejercicios1/basedatos/webemple/funciones.php -->
