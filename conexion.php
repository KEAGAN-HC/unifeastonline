
<?php
$host = "unifeast.mysql.database.azure.com";
$user = "ryanhers11yh";
$clave = "Apollo01";
$bd = "card";

// Inicializa la conexión
$conexion = mysqli_init();

// Realiza la conexión sin SSL
if (!mysqli_real_connect($conexion, $host, $user, $clave, $bd, 3306)) {
    echo "No se pudo conectar a la base de datos: " . mysqli_connect_error();
    exit();
}

// Selecciona la base de datos
mysqli_select_db($conexion, $bd) or die("No se encuentra la base de datos");

// Establece el conjunto de caracteres
mysqli_set_charset($conexion, "utf8");
