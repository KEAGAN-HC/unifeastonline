<?php
session_start(); // Iniciar la sesión al principio del script

// Verificar si el usuario ya ha iniciado sesión
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header("Location: index.php"); // Redirigir a la página principal si ya ha iniciado sesión
    exit();
}

// Conexión a la base de datos (reemplaza con tus credenciales)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "card";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Verificar si el formulario ha sido enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener datos del formulario y sanitizarlos
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password']; 

    // Consulta preparada para evitar inyección SQL
    $stmt = $conn->prepare("SELECT * FROM clientes WHERE correo = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['clave'])) {
            // Inicio de sesión exitoso
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $row['id'];
            $_SESSION['correo'] = $row['correo'];

            // Redirigir a la página principal u otra página protegida
            header("Location: index.php");
            exit(); 
        } else {
            $error = "Contraseña incorrecta.";
        }
    } else {
        $error = "Correo electrónico no encontrado.";
    }

    // Cerrar la sentencia preparada
    $stmt->close();
}

// Cerrar la conexión a la base de datos
$conn->close();
?>
