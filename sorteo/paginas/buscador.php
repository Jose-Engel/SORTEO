<?php
include '../config/conexion.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscador</title>
    <link rel="shorcut icon" href="img/iconbar.png">
    <link rel="stylesheet" href="../css/buscador.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
</head>
<body>

<header>
<a href="../index.html" class="home-link">
            <img src="../assets/home.svg" alt="Home" width="30" height="30" class="home-icon">
        </a> 
</header>
<form>
<div class="buscador">
    <form action="buscador.php" method="get">
        <input type="text" name="busqueda" placeholder="Buscar">
        <button type="submit" name="enviar" class="btn">
            <i class="fa fa-search"></i>
        </button>
    </form>
</div>
<form action="buscador.php" method="get">
    <button type="submit" name="FiltroCat" value="Desayuno">Desayuno</button>
    <button type="submit" name="FiltroCat" value="Almuerzo">Almuerzo</button>
    <button type="submit" name="FiltroCat" value="Cena">Cena</button>
</form>

    <div class="heading">
        <h1>Recetas</h1>
        <h3>&mdash; LowMenu &mdash; </h3>
    </div>

    <div class="menu">
<?php
if(isset($_GET['enviar'])){
    $busqueda = $_GET['busqueda'];
    $consulta = $con->query("SELECT * FROM recetas WHERE nombre_receta LIKE '%$busqueda%'");
    if ($consulta->num_rows > 0) {
        echo '<div class="recetas-container">';
        while ($row = $consulta->fetch_array()) {
            echo '<div class="receta-box">';
            echo '<form action="ver_receta.php" method="get">';
            echo '<input type="hidden" name="id_receta" value="' . $row['id_receta'] . '">';
            echo '<img src="' . $row['ruta_imagen'] . '" alt="Imagen de la receta" class="receta-imagen">'; // Descomentar esta línea
            echo '<div class="contenido-receta">';
            echo '<p><strong>' . $row['nombre_receta'] . '</strong></p>';
            echo '<div class="detalles-receta">';
            echo '<p><i class="fa-regular fa-user"></i> ' . $row['porciones'] . '</p>';
            echo '<p><i class="fa-solid fa-bowl-food"></i> ' . $row['tipo_coccion'] . '</p>';
            echo '<p><i class="fa-solid fa-clock"></i> ' . $row['tiempo_preparacion'] . '</p>';
            echo '<p><i class="fa-solid fa-dollar-sign"></i> ' . $row['costo_aprox'] . ' MXN</p>';
            echo '</div>';
            echo '<p>' . $row['descripcion'] . '</p>';
            echo '<div class="button-container">'; 
            echo '<button type="submit">Ver Receta</button>';
            echo '</div>';
            echo '</div>';
            echo '</form>';
            echo '</div>';
        }
        echo '</div>';
    } else {
        echo "No se encontraron resultados.";
    }
}

if(isset($_GET['FiltroCat'])){
    $valorBoton = $_GET['FiltroCat'];
    $consulta = $con->query("SELECT * FROM recetas WHERE categoria = '$valorBoton'");
    
    echo '<div class="recetas-container">';
    while ($row = $consulta->fetch_array()) {
        echo '<div class="receta-box">';
        echo '<form action="ver_receta.php" method="get">';
        echo '<input type="hidden" name="id_receta" value="' . $row['id_receta'] . '">';
        echo '<img src="' . $row['ruta_imagen'] . '" alt="Imagen de la receta" class="receta-imagen">'; // Descomentar esta línea
        echo '<div class="contenido-receta">';
        echo '<p><strong>' . $row['nombre_receta'] . '</strong></p>';
        echo '<div class="detalles-receta">';
        echo '<p><i class="fa-regular fa-user"></i> ' . $row['porciones'] . '</p>';
        echo '<p><i class="fa-solid fa-bowl-food"></i> ' . $row['tipo_coccion'] . '</p>';
        echo '<p><i class="fa-solid fa-clock"></i> ' . $row['tiempo_preparacion'] . '</p>';
        echo '<p><i class="fa-solid fa-dollar-sign"></i> ' . $row['costo_aprox'] . ' MXN</p>';
        echo '</div>';
        echo '<p>' . $row['descripcion'] . '</p>';
        echo '<div class="button-container">'; 
        echo '<button type="submit">Ver Receta</button>';
        echo '</div>';
        echo '</div>';
        echo '</form>';
        echo '</div>';
    }
    echo '</div>';
}

?>

</div>
</body>
</html>