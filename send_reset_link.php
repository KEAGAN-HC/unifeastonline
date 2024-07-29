<?php
// Incluir archivo de configuración de la base de datos
require 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['correo'])) {
        $correo = $_POST['correo'];

        // Consultar si el correo existe en la base de datos
        $stmt = $conexion->prepare("SELECT id FROM clientes WHERE correo = ?");
        $stmt->bind_param("s", $correo);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            // El correo existe, generar un token y enviar el correo de restablecimiento
            $token = bin2hex(random_bytes(50));
            $stmt->bind_result($id);
            $stmt->fetch();
            $expiry = date('Y-m-d H:i:s', strtotime('+1 hour'));

            // Insertar el token en la base de datos con fecha de expiración
            $stmt = $conexion->prepare("INSERT INTO password_resets (cliente_id, token, expiry) VALUES (?, ?, ?)");
            $stmt->bind_param("iss", $id, $token, $expiry);
            $stmt->execute();

            // Enviar el correo de restablecimiento
            $resetLink = "http://localhost/unifeast/reset_password.php?token=" . $token;
            $to = $correo;
            $subject = "Restablecer tu contraseña";
            $message = "Haz clic en el siguiente enlace para restablecer tu contraseña: $resetLink";
            $headers = 'From: unifeastoficial@gmail.com' . "\r\n" .
                       'Reply-To: your_email@gmail.com' . "\r\n" .
                       'X-Mailer: PHP/' . phpversion();

            if (mail($to, $subject, $message, $headers)) {
                echo "Se ha enviado un enlace de restablecimiento a tu correo electrónico.";
            } else {
                echo "Error al enviar el correo.";
            }
        } else {
            echo "Correo electrónico no encontrado.";
        }

        $stmt->close();
    } else {
        echo "Correo electrónico no proporcionado.";
    }
}

$conexion->close();
?>
