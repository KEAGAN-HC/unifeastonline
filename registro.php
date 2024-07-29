<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <title>Registro</title>
    <link rel="stylesheet" href="assets/css/loginstyles.css"> 
</head>
<body>
    <div class="container-register"> 
        <div class="login-container">

            <div class="container-logo-login">
                <a href="<?php echo isset($_SESSION['user_id']) ? 'perfil.php' : 'iniciosesion.php'; ?>">
                    <img src="img/UNIFEAST SIN COMEDOR.png" alt="" />
                </a>
            </div>

            <h2 class="login-title">Registro</h2>

            <?php
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $nombre = $_POST['nombre'];
                $correo = $_POST['correo'];
                $matricula = $_POST['matricula'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $confirmar_password = $_POST['confirmar_password'];

                $errores = [];

                if ($password !== $confirmar_password) {
                    $errores[] = "Las contraseñas no coinciden.";
                }

                if (empty($nombre) || empty($correo) || empty($matricula) || empty($username) || empty($password)) {
                    $errores[] = "Todos los campos son obligatorios.";
                }

                if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                    $errores[] = "El formato del correo electrónico no es válido.";
                }

                if (empty($errores)) {
                    $servername = "localhost";
                    $db_username = "root";
                    $db_password = "";
                    $dbname = "card";

                    $conn = new mysqli($servername, $db_username, $db_password, $dbname);

                    if ($conn->connect_error) {
                        die("Conexión fallida: " . $conn->connect_error);
                    }

                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

                    $sql = "INSERT INTO clientes (nombre, correo, matricula, username, password) VALUES ('$nombre', '$correo', '$matricula', '$username', '$hashed_password')";

                    if ($conn->query($sql) === TRUE) {
                        echo "<p>Registro exitoso. Redirigiendo al <a href='index.php'>inicio</a>.</p>";
                        header("refresh:3;url=index.php");
                    } else {
                        echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
                    }

                    $conn->close();
                } else {
                    foreach ($errores as $error) {
                        echo "<p>$error</p>";
                    }
                }
            }
            ?>

            <form class="login-form" action="registro.php" method="post"> 
                <label for="nombre">Nombre:</label>
                <input type="text" id="nombre" name="nombre" required>

                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" required>

                <label for="username">Confirmar correo:</label>
                <input type="email" id="username" name="username" required>

                <label for="matricula">Matrícula:</label>
                <input type="text" id="matricula" name="matricula" required>

                <label for="password">Contraseña:</label>
                <input type="password" id="password" name="password" required>

                <label for="confirmar_password">Confirmar Contraseña:</label>
                <input type="password" id="confirmar_password" name="confirmar_password" required>

                <button type="submit" class="btn-login">Registrarse</button>
            </form>

            <p class="register-text">¿Ya tienes cuenta? <a href="iniciosesion.php" class="btn-register">Iniciar Sesión</a></p>
        </div>
    </div>
</body>
</html>
