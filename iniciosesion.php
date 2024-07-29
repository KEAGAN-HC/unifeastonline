<?php
session_start();

$errores = [];
$mensaje_exito = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) || empty($password)) {
        $errores[] = "Todos los campos son obligatorios.";
    }

    if (empty($errores)) {
        // Conexión a la base de datos
        $servername = "localhost";
        $db_username = "root";
        $db_password = "";
        $dbname = "card";

        $conn = new mysqli($servername, $db_username, $db_password, $dbname);

        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        // Consulta SQL utilizando consultas preparadas para evitar inyecciones SQL
        $sql = "SELECT id, password, nombre, correo, matricula FROM clientes WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['username'] = $username;
                $_SESSION['nombre'] = $row['nombre'];
                $_SESSION['correo'] = $row['correo'];
                $_SESSION['matricula'] = $row['matricula'];
                $mensaje_exito = "Inicio de sesión exitoso. Redirigiendo...";
                echo "<script>
                    setTimeout(function() {
                        window.location.href = 'index.php';
                    }, 3000);
                    </script>";
            } else {
                $errores[] = "Nombre de usuario y/o contraseña incorrecta.";
            }
        } else {
            $errores[] = "No existe una cuenta vinculada con este nombre de usuario.";
        }

        $stmt->close();
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de Sesión</title>
    <link rel="stylesheet" href="assets/css/loginstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container-register">
        <div class="login-container">

            <div class="container-logo-login">
                <a href="index.php"><img src="img/UNIFEAST SIN COMEDOR.png" alt="" /></a>
            </div>

            <h2 class="login-title">Iniciar Sesión</h2>

            <form class="login-form" action="iniciosesion.php" method="post">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" required>

                <label for="password">Contraseña</label>
                <input type="password" id="password" name="password" required>

                <button type="submit" class="btn-login">Iniciar Sesión</button>
            </form>
            
            <?php
            if (!empty($errores)) {
                echo '<div class="error-messages">';
                foreach ($errores as $error) {
                    echo "<p>$error</p>";
                }
                echo '</div>';
            }
            if ($mensaje_exito) {
                echo '<div class="success-message"><p>' . $mensaje_exito . '</p></div>';
            }
            ?>
            
            <p class="register-text">¿No tienes una cuenta? <a href="registro.php" class="btn-register">Regístrate</a></p>
            <p class="register-text">¿Olvidaste tu contraseña? <a href="request_password_reset.php" class="btn-register">Recuperala aqui</a></p>
        </div>
    </div>
</body>

</html>
