<?php
function incremento($numero){
    $numero = substr($numero,1);
    if ($numero==0) {
        $numero=0;
    }
    $numero++;
    $numero = str_pad($numero,3,"0",STR_PAD_LEFT);
    return "C" . $numero;
}

?>


include_once 'footer.php';