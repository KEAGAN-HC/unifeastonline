<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once "config/conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = mysqli_real_escape_string($conexion, $_POST['nombre']);
    $email = mysqli_real_escape_string($conexion, $_POST['email']);
    $contraseña = password_hash($_POST['contraseña'], PASSWORD_BCRYPT);

    // Verifica si el correo electrónico ya existe
    $checkEmailQuery = "SELECT * FROM usuariosm WHERE email='$email'";
    $result = mysqli_query($conexion, $checkEmailQuery);
    if (mysqli_num_rows($result) > 0) {
        echo "El correo electrónico ya está registrado.";
    } else {
        // Inserta el nuevo usuario
        $sql = "INSERT INTO usuariosm (nombre, email, contraseña) VALUES ('$nombre', '$email', '$contraseña')";
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
</head>
<body>
    <form action="registro.php" method="post">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br>
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="contraseña">Contraseña:</label>
        <input type="password" id="contraseña" name="contraseña" required><br>
        <button type="submit">Registrarse</button>
    </form>
</body>
</html>
