<?php
$alumnas = array("Isabel"=>30,"Ana"=>19,"Mapi"=>22,"Xiao"=>"27","Carmen"=>35);
//a. recorerr array con bucle
foreach ($alumnas as $key => $value) {
    echo "[". $key ."]  =>  " . $value . "<br>";
}
//b. situar el puntero en [1] e imprimir el valor
echo next($alumnas) . "<br>";
//c
echo next($alumnas) . "<br>";
//d
echo end($alumnas) . "<br>"; 
//e
asort($alumnas);
echo "<pre>";
print_r($alumnas);
echo "</pre>";

echo  next($alumnas) . " " . key($alumnas) . "<br>" ;
echo end($alumnas) . " " . key($alumnas) . "<br>" ;

?>