<!-- <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form  action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
<h2>Registro de cliente</h2>
        <label>Introduce el NIF    
        <input type="text" name="NIF"> </label><br>

        <input type="submit">
</form>
</body>
</html> -->
<?php

require_once 'funciones.php';




$string = "C      ristina";
$string=str_replace("  ","",$string);

echo $string . "<br>";
echo strrev($string);



// $numero = C000;
// $numero = substr($numero,1);
// $numero++;
//$cantidad = strlen($numero);
//echo $cantidad . "<br>";

//while ($cantidad < 3) {
    //str_pad($letra,(3-$cantidad),"0");
  //  $cantidad++;
//}
//echo $letra . $numero;
// STR_PAD_LEFT




// $valor1 = strrev($valor);
// $array = (str_split($valor1,3));

// print_r($array);
// $valor1 = $array[0];
//$valor1++;
// echo $valor1;
//if ($valor1<=9) {
    //$valor1 = "00" . $valor1;
//}elseif ($valor1<=99) {
    //$valor1 = "0" . $valor1;
//}
//echo $valor1;





// $NIFerr = "";

// if (empty($_POST["NIF"])) {
//     $NIFerr="NIF es un campo obligatorio";
//     echo $NIFerr;

// }else {
//     $NIF = limpieza($_POST["NIF"]);
//     if (!preg_match("/^[0-9]{8}[A-Za-z]$/",$NIF)) {
//         $NIFerr="NIF debe componer de 8 dígitos + 1 letra";
//         echo $NIFerr;

//     }else{
//         echo "correcta";
//     }
// }
      

?>