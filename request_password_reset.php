<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link rel="stylesheet" href="assets/css/loginstyles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>

<body>
    <div class="container-register">
        <div class="login-container">

            <div class="container-logo-login">
                <a href="index.php"><img src="img/UNIFEAST SIN COMEDOR.png" alt="" /></a>
            </div>

            <h2 class="login-title">Restablecer Contraseña</h2>

            <form class="login-form" action="send_reset_link.php" method="POST">
                <label for="correo">Correo Electrónico:</label>
                <input type="email" id="correo" name="correo" required>

                <button type="submit" class="btn-login">Enviar Enlace de Restablecimiento</button>
            </form>

            <?php
            if (!empty($errores)) {
                echo '<div class="error-messages">';
                foreach ($errores as $error) {
                    echo "<p>$error</p>";
                }
                echo '</div>';
            }
            
            
            ?>
            
            <p class="register-text">¿Recordaste tu contraseña? <a href="iniciosesion.php" class="btn-register">Iniciar Sesión</a></p>
        </div>
    </div>
</body>

</html>
