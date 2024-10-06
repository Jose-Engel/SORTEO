<?php
include '../config/conexion.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receta</title>
    <link rel="stylesheet" href="../css/visualizador.css">
    <link rel="shorcut icon" href="img/iconbar.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="sha512-z3gLpd7yknf1YoNbCzqRKc4qyor8gaKU1qmn+CShxbuBusANI9QpRohGBreCFkKxLhei6S9CQXFEbbKuqLg0DA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<header>
<a href="../index.html" class="home-link">
            <img src="../assets/home.svg" alt="Home" width="30" height="30" class="home-icon">
        </a> 
    <a href="https://recetario.lowmenu.online/paginas/buscador.php?busqueda=&enviar=" class="back-link">
        <img src="../assets/back.svg" alt="back" width="30" height="30" class="back-icon">
    </a> 
</header>

<?php
if (isset($_GET['id_receta'])) {
    // Obtener el id_receta de la URL
    $id_receta = $_GET['id_receta'];

    // Realizar una consulta para obtener los detalles de la receta según el id_receta
    // Asegúrate de sanitizar y validar el valor de id_receta para evitar SQL injection
    $consulta_receta = $con->query("SELECT * FROM recetas WHERE id_receta = $id_receta");

    // Verificar si se encontraron resultados
    if ($consulta_receta->num_rows > 0) {
        // Mostrar la información de la receta
        $row_receta = $consulta_receta->fetch_assoc();
?>
        <body>
            <div class="container">
            <h1 class="seccion"><?php echo $row_receta['nombre_receta']; ?></h1>
                <img class="imagen-receta" src="<?php echo $row_receta['ruta_imagen']; ?>" alt="Imagen de la receta">
                <p class="receta-info"><i class="fa-regular fa-user"></i> <?php echo $row_receta['porciones']; ?>
                        <i class="fa-solid fa-bowl-food"></i> <?php echo $row_receta['tipo_coccion']; ?>
                        <i class="fa-solid fa-clock"></i> <?php echo $row_receta['tiempo_preparacion']; ?>
                        <i class="fa-solid fa-dollar-sign"></i> <?php echo $row_receta['costo_aprox']; ?> MXN</p>
                        <p class="receta-info"><?php echo $row_receta['descripcion']; ?></p>
                <div class="detalles-receta2">
                <h2 class="seccion">Lista de Ingredientes</h2>

                 <li>
                    <input type="checkbox" id="ingrediente1">
                    <label for="ingrediente1">Ingrediente 1</label>
                </li>
                <li>
                    <input type="checkbox" id="ingrediente2">
                    <label for="ingrediente2">Ingrediente 2</label>
                </li>
                <li>
                    <input type="checkbox" id="ingrediente3">
                    <label for="ingrediente3">Ingrediente 3</label>
                </li>

                <li>
                    <input type="checkbox" id="ingrediente4">
                    <label for="ingrediente3">Ingrediente 4</label>
                </li>

                <li>
                    <input type="checkbox" id="ingrediente5">
                    <label for="ingrediente3">Ingrediente 5</label>
                </li>
    <!-- Agregar más elementos según sea necesario -->
                </ul>

                    <p class="seccion"><strong>Instrucciones:</strong></p>

                    <?php
                    // Dividir las instrucciones en diferentes filas
                    $instrucciones = explode("\n", $row_receta['instrucciones']);
                    foreach ($instrucciones as $linea) {
                        echo '<p>' . $linea . '</p>';
                    }
                    ?>
                </div>

            </div>
        </body>
<?php
    } else {
        echo "La receta no fue encontrada.";
    }
} else {
    echo "ID de receta no proporcionado.";
}
?>

<!-- Sección de Sugerencias -->

<div class="sugerencias">
<div class="container">
    <h2 class="seccion">Sugerencias</h2>
</div>
    <?php
    // Consulta para obtener tres recetas aleatorias
    $sql = "SELECT * FROM recetas ORDER BY RAND() LIMIT 3";
    $result = $con->query($sql);

    // Mostrar las recetas aleatorias
    if ($result->num_rows > 0) {
        echo '<div class="recetas-container">';
        while ($row = $result->fetch_assoc()) {
            echo '<div class="receta-box">';
            echo '<form action="ver_receta.php" method="get">';
            echo '<input type="hidden" name="id_receta" value="' . $row['id_receta'] . '">';
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
            echo '</form>';
            echo '</div>';
        }
    } else {
        echo "No se encontraron recetas aleatorias.";
    }
    echo '</div>';

    ?>
</div>

</body>
</html>