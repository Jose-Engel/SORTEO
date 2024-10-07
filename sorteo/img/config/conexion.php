<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Comapatible" content="IE-edge">
    <meta name="viewport" content="with-device-width, inital-scale=1.0">


</head>

<body>
    <?php
    $con=mysqli_connect("localhost", "root","admin123","lowmenu");
    
    if(!$con){
            die("no pudo conectarse a la base de datos".mysqli_error());
    }
?>
</body>