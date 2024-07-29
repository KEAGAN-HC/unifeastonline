<?php
require_once "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $usuario = mysqli_real_escape_string($conexion, $_POST['usuario']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);

    // Verifica si el correo electrónico ya existe
    $checkEmailQuery = "SELECT * FROM usuarios WHERE email='$email' OR usuario='$usuario'";
    $result = mysqli_query($conexion, $checkEmailQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "El correo electrónico o el usuario ya están registrados.";
    } else {
        // Inserta el nuevo usuario
        $sql = "INSERT INTO usuarios (nombre, email, usuario, contraseña) VALUES ('$nombre', '$email', '$usuario', '$contraseña')";
        if (mysqli_query($conexion, $sql)) {
            echo "Registro exitoso. Redirigiendo a la página de inicio de sesión...";
            header("refresh:3;url=inicio_sesion.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conexion);
        }
    }

    mysqli_close($conexion);
}
?>
