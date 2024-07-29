<?php
// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "card";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Obtener datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$confirmarContrasena = $_POST['confirmar-contrasena'];

// Validación básica y verificación de correo existente
$errors = array(); // Array para almacenar mensajes de error

if ($contrasena !== $confirmarContrasena) {
    $errors[] = "Las contraseñas no coinciden.";
}

if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors[] = "El correo electrónico no es válido.";
} else {
    // Verificar si el correo ya existe (usando sentencia preparada)
    $stmt_check = $conn->prepare("SELECT * FROM clientes WHERE correo = ?");
    $stmt_check->bind_param("s", $email);
    $stmt_check->execute();
    $result = $stmt_check->get_result();

    if ($result->num_rows > 0) {
        $errors[] = "El correo electrónico ya está registrado.";
    }
}

if (empty($errors)) {
    // Hashear la contraseña
    $hashedPassword = password_hash($contrasena, PASSWORD_DEFAULT);

    // Consulta SQL para insertar el nuevo usuario (usando sentencia preparada)
    $stmt = $conn->prepare("INSERT INTO clientes (nombre, correo, clave) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $nombre, $email, $hashedPassword);

    if ($stmt->execute()) {
        // Redireccionar a index.php después del registro exitoso
        header("Location: index.php");
        exit();
    } else {
        echo "Error al registrar: " . $stmt->error;
    }
} else {
    // Mostrar mensajes de error
    foreach ($errors as $error) {
        echo $error . "<br>";
    }
}

$conn->close();
?>
