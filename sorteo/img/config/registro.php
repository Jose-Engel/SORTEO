<?php
include 'conexion.php';

if ($con->connect_error) {
    die("Conexión fallida: " . $con->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validación de datos
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!$email || empty($username) || empty($password) || empty($confirm_password)) {
        echo "Por favor, completa todos los campos correctamente.";
    } elseif ($password != $confirm_password) {
        echo "Las contraseñas no coinciden";
    } else {
        // Hashear la contraseña
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insertar el nuevo usuario en la base de datos (consulta preparada)
        $insert_query = $con->prepare("INSERT INTO usuarios (id_usuario, nombre_usuario, correo_electronico, contrasena) VALUES (NULL ,?, ?, ?)");
        $insert_query->bind_param("sss", $username, $email, $hashed_password);


        if ($insert_query->execute()) {
            echo "Usuario registrado correctamente";
        } else {
            echo "Error al registrar usuario: " . $con->error;
        }
    }
}
?>