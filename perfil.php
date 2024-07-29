<?php
session_start();

// Simulando datos de usuario. En una aplicación real, obtendrías estos datos de la base de datos.
$username = isset($_SESSION['username']) ? $_SESSION['username'] : 'Nombre de usuario';
$email = isset($_SESSION['correo']) ? $_SESSION['correo'] : 'correo@ejemplo.com';
$nombre = isset($_SESSION['nombre']) ? $_SESSION['nombre'] : 'Nombre completo';
$matricula = isset($_SESSION['matricula']) ? $_SESSION['matricula'] : 'Matricula';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
    <link rel="stylesheet" href="assets/css/loginstyles.css">
</head>
<body>
    <div class="container-register">
        <div class="login-container">

            <div class="container-logo-login">
                <a href="index.php"><img src="img/UNIFEAST SIN COMEDOR.png" alt="Logo" /></a>
            </div>

            <h2 class="login-title">Perfil de Usuario</h2>

            <form class="login-form" action="update_profile.php" method="POST">
                <label for="username">Nombre de Usuario</label>
                <input type="text" id="username" name="username" class="form-input" value="<?php echo $username; ?>" disabled>

                <label for="nombre">Nombre Completo</label>
                <input type="text" id="nombre" name="nombre" class="form-input" value="<?php echo $nombre; ?>" disabled>

                <label for="email">Correo Electrónico</label>
                <input type="email" id="email" name="email" class="form-input" value="<?php echo $email; ?>" disabled>

                <label for="matricula">Matrícula</label>
                <input type="text" id="matricula" name="matricula" class="form-input" value="<?php echo $matricula; ?>" disabled>

                <label for="password">Nueva Contraseña</label>
                <input type="password" id="password" name="password" class="form-input">

                <button type="submit" class="btn-login">Actualizar Perfil</button>
            </form>
            <p class="register-text"><a href="consultar_pedidos.php" class="btn-register">Mis Pedidos</a></p>

            <p class="register-text"><a href="logout.php" class="btn-register">Cerrar Sesión</a></p>
        </div>
    </div>

    <script>
    </script>
</body>
</html>
