<?php
include 'conexion.php';
?>

<?php
session_start();

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Consulta SQL para obtener usuario por email
    $sql = "SELECT * FROM usuarios WHERE correo_electronico='$email'";
    $result = $con->query($sql);

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['contrasena'])) { // Corregido el nombre de la columna
            $_SESSION['email'] = $email; // Establecer la sesión del usuario
            header("Location: ../index.html"); // Redirigir al perfil del usuario
            exit();
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }
}
?>
