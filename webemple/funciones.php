<?php
//PDO
function conexion(){
    $servername = "localhost:8889";
    $username = "root";
    $password = "root";
    $dbname = "webemple";

    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    return $conn;
}


#DEPARTAMENTO
    //sacar max id
function max_codigo ($conn){
    $stmt = $conn->prepare("SELECT MAX(cod_dpto)as max_cod FROM departamento");
    $stmt->execute(); //excute
    $resultado = $stmt -> fetch(PDO::FETCH_ASSOC); //devuelve un array con un solo elemento
    $codigo = $resultado['max_cod']; //sacar el valor de la posición "max_cod"
    return $codigo;
}

    //insertar una nueva fila
function insert_dpto($conn,$cod_dpto,$nombre_dpto){
    $stmt = $conn->prepare("INSERT INTO departamento (cod_dpto,nombre_dpto) VALUES (:cod_dpto,:nombre_dpto)");
    $stmt->bindParam(':cod_dpto', $cod_dpto);
    $stmt->bindParam(':nombre_dpto', $nombre_dpto);
    $stmt->execute();
}

    //lista de departamento: muestra los nombres pero envia el codigo  
function tabla_dpto($conn,$mensaje){
    $stmt = $conn->prepare("SELECT cod_dpto,nombre_dpto FROM departamento");
    $stmt->execute(); //excute
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $list_cod = $stmt->fetchAll();
      
        
    echo "<label for='dpto'>" . $mensaje . "</label>";
     
    echo "<select name='dpto_seleccionado' id='dpto'>";
    foreach($list_cod as $row) { 
     
        echo "<option value= " . $row["cod_dpto"]. ">" . $row["nombre_dpto"] . "</option>";
    //selecciona codigo pero muestra el nombre
    }
    echo "</select>" . "<br>"; 
}


#EMPLEADO
    //
function tabla_emple($conn){
    $stmt = $conn->prepare("SELECT dni, CONCAT (nombre,' ',apellidos) AS NomApe FROM empleado");
    $stmt->execute(); 
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $list_emp = $stmt->fetchAll();
       
    echo "<label for='emple'>Selecciona un empleado:</label>";
     
    echo "<select name='emple_seleccionado' id='emple'>";
    foreach($list_emp as $row) { 

        echo "<option value= " . $row["dni"]. ">" . $row["NomApe"]  . "</option>";
       //selecciona codigo pero muestra el nombre
    }
    echo "</select>" . "<br>"; 
}

    //insertar nueva fila en empleado
function insert_emple($conn,$dni,$nombre_emple,$apellido,$fecha_nac,$salario){
    //Insertar en table empleado!!              //estos son los campos de la tabla empleado       //esto son los valores introducido por usuario (en formato seguro y no directamente hacer con las variables)
    $stmt = $conn->prepare("INSERT INTO empleado (dni,nombre,apellidos,fecha_nac,salario) VALUES (:dni,:nombre_emple,:apellido,:fecha_nac,:salario)");
    $stmt->bindParam(':dni',$dni); //seguridad, evitar inyección
    $stmt->bindParam(':nombre_emple', $nombre_emple);
    $stmt->bindParam(':apellido',$apellido);
    $stmt->bindParam(':fecha_nac',$fecha_nac);
    $stmt->bindParam(':salario', $salario);
    $stmt->execute();
}

#TRABAJA
function insert_empledpto($conn,$dni,$dpto_seleccionado,$fecha_ini){
    $fecha_fin;
    //cod_dpto se almacena en tabla trabaja, junto con algunos otros datos introducidos por usuario
    //Insertar en table trabaja!!              //estos son los campos de la tabla trabaja       //esto son los valores introducido por usuario (en formato seguro y no directamente hacer con las variables)
    $stmt = $conn->prepare("INSERT INTO emple_depart (dni,cod_dpto,fecha_ini,fecha_fin) VALUES (:dni,:dpto_seleccionado,:fecha_ini,:fecha_fin)");
    $stmt->bindParam(':dni',$dni); //seguridad, evitar inyección
    $stmt->bindParam(':dpto_seleccionado', $dpto_seleccionado);
    $stmt->bindParam(':fecha_ini',$fecha_ini);
    $stmt->bindParam(':fecha_fin',$fecha_fin);

    $stmt->execute();
}

function bucle_mostrar_table($resultado,$fecha){
    
    echo "<br><table>";
    echo "<tr> <td>DNI</td> <td>Nombre</td><td>" . $fecha . "</td></tr>";

    foreach($resultado as $row) {
        echo "<tr>";
        echo "<td>" . $row["dni"] . "</td>";     //imprimir valor correspondiente del índice "dni"
        echo "<td>" . $row["NomApe"] . "</td>";   //imprimir valor correspondiente del índice "NomApe"
        echo "<td>" . $row[$fecha] . "</td>";  //imprimir valor correspondiente del índice "fecha"
        echo "</tr>";
    }
    echo "</table>";
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


