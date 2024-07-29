<?php
require_once "config/conexion.php";

$token = $_GET['token'] ?? '';

if ($token) {
    $query = $conexion->prepare("SELECT * FROM password_resets WHERE token = ? AND expiry > NOW()");
    $query->bind_param("s", $token);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $reset = $result->fetch_assoc();
        $cliente_id = $reset['cliente_id'];
    } else {
        echo "Token inválido o expirado.";
        exit;
    }
} else {
    echo "Token no proporcionado.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Restablecer Contraseña</title>
</head>
<body>
  <h2>Restablecer Contraseña</h2>
  <form action="update_password.php" method="POST">
    <input type="hidden" name="token" value="<?php echo htmlspecialchars($token); ?>">
    <label for="password">Nueva Contraseña:</label>
    <input type="password" id="password" name="password" required>
    <button type="submit">Restablecer Contraseña</button>
  </form>
</body>
</html>
