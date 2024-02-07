<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <style>
        body{
            margin-left: 40%;
            padding-top: 5%;
            font-size: 20px;
        }
    </style> -->
    <title>LogIn</title>
</head>
<body>
<h2>Log In</h2>
<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']);?>" method="post">
    <label>Usuario: 
        <input type="text" name="usuario">
    </label><br>

    <label>Contraseña: 
        <input type="text" name="contrasenia">
    </label><br>

    <input type="submit">

</form>
    
</body>
</html>