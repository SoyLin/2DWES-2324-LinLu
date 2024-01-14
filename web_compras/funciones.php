<?php
//PDO
function conexion(){
    $servername = "localhost:8889";
    $username = "root";
    $password = "root";
    $dbname = "comprasweb";//nombre de bases de datos, escribir el nombre correcto para conectar con el BBDD correspondiente

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    return $conn;
}
#¡MISMA FUNCIÓN PARA MULTIPLES TABLAS!
  //sacar max id
  function max_codigo ($conn,$ID_campo,$table){//hacer select MEDIANTE la conexión $conn que HABIAMOS ESTABLECIDO ANTERIORMENTE
    $stmt = $conn->prepare("SELECT MAX($ID_campo)as max_id FROM $table");
    $stmt->execute(); //excute
    $resultado = $stmt -> fetch(PDO::FETCH_ASSOC); //devuelve un array con un solo elemento
    $codigo = $resultado['max_id']; //sacar el valor de la posición "max_cod"
    return $codigo;

    // echo "<pre>";
    // print_r($resultado);
    // echo "</pre>";
}

    //listas: MOSTRAR los nombres pero envia el codigo  
    function list_cat($conn,$ID_campo_list,$Otros_campos,$table_list,$mensaje,$name_indice){
        $stmt = $conn->prepare("SELECT $ID_campo_list,$Otros_campos FROM $table_list");
        $stmt->execute(); //excute
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $multi_fila = $stmt->fetchAll();
        
        echo "<label for='list'>" . $mensaje . "</label>";
        echo "<select id='list' name=" . $name_indice . ">";
        foreach ($multi_fila as $aray) {
            echo "<option value=" . $aray[$ID_campo_list] . ">" . $aray[$Otros_campos] . "</option>";
            //muestra "NOMBRE" pero selecciona "ID" , porque es el valor que se almacena en value 

        }
        echo "</select>" . "<br>";
    }
    
//INCREMENTO DE CÓDIGO
function incremento($numero,$letra){
    $numero = substr($numero,1);
    if ($numero==0) {
        $numero=0;
    }
    $numero++;
    $numero = str_pad($numero,3,"0",STR_PAD_LEFT); //rellenar con 0s hasta alcanzar la longitud que hemos indicado
    return $letra . $numero;
}

//LIMPIEZA DE DATOS + MAYÚSCULA
function limpieza($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = strtoupper($data);
    return $data;
}



?>


