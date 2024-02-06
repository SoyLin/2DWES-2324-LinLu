<?php
session_start(); //recuperar phpsesionID

if(!isset($_SESSION["usuario"])) { //comprobar si ha pasado por login
    echo "Sesion no definida";  //si NO está establecida la variable -> no ha pasado por login -> es una copia de enlace
    header("Location: pe_login.php"); //DEBE loguearse primero
} else {

	// Se incluye la librería
	include 'apiRedsys.php';

	// Se crea Objeto
	$miObj = new RedsysAPI;

	// Valores de entrada que no hemos cmbiado para ningun ejemplo
	$fuc="999008881";
	$terminal="1";
	$moneda="978";
	$trans="0";
	$url="http://192.168.206.209/Pedidos/pe_altaped.php";
	$urlOKKO="http://192.168.206.209/Pedidos/pe_altaped.php";
	$id=time();
	$amount= $_SESSION["amount"];	
	
	// Se Rellenan los campos
	$miObj->setParameter("DS_MERCHANT_AMOUNT",$amount);
	$miObj->setParameter("DS_MERCHANT_ORDER",$id);
	$miObj->setParameter("DS_MERCHANT_MERCHANTCODE",$fuc);
	$miObj->setParameter("DS_MERCHANT_CURRENCY",$moneda);
	$miObj->setParameter("DS_MERCHANT_TRANSACTIONTYPE",$trans);
	$miObj->setParameter("DS_MERCHANT_TERMINAL",$terminal);
	$miObj->setParameter("DS_MERCHANT_MERCHANTURL",$url);
	$miObj->setParameter("DS_MERCHANT_URLOK",$urlOKKO);
	$miObj->setParameter("DS_MERCHANT_URLKO",$urlOKKO);

	//Datos de configuración
	$version="HMAC_SHA256_V1";
	$kc = 'sq7HjrUOBfKmC576ILgskD5srU870gJ7';//Clave recuperada de CANALES
	// Se generan los parámetros de la petición
	$request = "";
	$params = $miObj->createMerchantParameters();
	$signature = $miObj->createMerchantSignature($kc);

 
	echo phpversion();
}

?>
<html lang="es">
<head>
</head>
<body>
<form name="frm" action="https://sis-t.redsys.es:25443/sis/realizarPago" method="POST" target="_blank">
Ds_Merchant_SignatureVersion <input type="text" name="Ds_SignatureVersion" value="<?php echo $version; ?>"/></br>
Ds_Merchant_MerchantParameters <input type="text" name="Ds_MerchantParameters" value="<?php echo $params; ?>"/></br>
Ds_Merchant_Signature <input type="text" name="Ds_Signature" value="<?php echo $signature; ?>"/></br>
<input type="submit" value="Enviar" >
</form>

</body>
</html>
