<?php
session_start();
session_unset();
session_destroy();
// set_cookie("PHPSESSID","",time()-3600,"/");


header("Location: comlogincli.php");
?>