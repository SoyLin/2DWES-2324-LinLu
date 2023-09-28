<HTML>
<BODY>
<?php

//1ºarray

$Indice = array("Indice");

for($contador = 0; $contador<=20; $contador++){

	$Indice[] = $contador;
  echo $Indice[$contador];
  echo "<br>";
}

//2ºarray

$Valor = array("Valor");

$numero=-1;
$totalImpares=0;
while($totalImpares<=20){
  $Valor[] = $numero+2;
  
  $numero+=2;
  $totalImpares++;
}

foreach($Valor as $clave => $valor) 
{
   echo $valor;
   echo "<br>";
}  


//3ºarray
$Suma = array("Suma");
for($i = 1; $i<=21; $i++){

  $Suma[] =	$Indice[$i]+ $Valor[$i] ;
  echo $Suma[$i-1];
  echo "<br>";
}





?>
</BODY>
</HTML>
