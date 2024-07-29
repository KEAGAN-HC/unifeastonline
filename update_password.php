<?php
require_once "config/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $token = $_POST['token'];
    $new_password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Comprobar si el token es válido y no ha expirado
    $query = $conexion->prepare("SELECT * FROM password_resets WHERE token = ? AND expiry > NOW()");
    $query->bind_param("s", $token);
    $query->execute();
    $result = $query->get_result();

    if ($result->num_rows > 0) {
        $reset = $result->fetch_assoc();
        $cliente_id = $reset['cliente_id'];

        // Actualizar la contraseña del cliente
        $query = $conexion->prepare("UPDATE clientes SET password = ? WHERE id = ?");
        $query->bind_param("si", $new_password, $cliente_id);

        if ($query->execute()) {
            // Eliminar el token de restablecimiento
            $query = $conexion->prepare("DELETE FROM password_resets WHERE token = ?");
            $query->bind_param("s", $token);
            $query->execute();

            echo "Contraseña actualizada exitosamente.";
        } else {
            echo "Error al actualizar la contraseña.";
        }
    } else {
        echo "Token inválido o expirado.";
    }
}
?>
