<?php
session_start();
require_once "config/conexion.php";

// Verifica si el cliente ha iniciado sesión
if (!isset($_SESSION['user_id'])) {
    echo "Por favor, inicia sesión para ver tus pedidos.";
    exit;
}

$cliente_id = $_SESSION['user_id'];

// Consulta para obtener los pedidos del cliente
$sql = "SELECT o.id, o.total, o.estado, o.created_at, GROUP_CONCAT(p.nombre SEPARATOR ', ') as productos 
        FROM ordenes o 
        JOIN orden_items oi ON o.id = oi.orden_id
        JOIN productos p ON oi.producto_id = p.id
        WHERE o.cliente_id = ?
        GROUP BY o.id, o.total, o.estado, o.created_at
        ORDER BY o.created_at DESC";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $cliente_id);
$stmt->execute();
$result = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UniFeast - Mis Pedidos</title>
    <link href="assets/css/styles.css" rel="stylesheet">
    <link href="assets/css/normalize.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="shortcut icon" href="/img/favicon-32x32.png">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/d139bfcb49.js" crossorigin="anonymous"></script>
</head>
<body>
    <header>
        <div class="container-hero">
            <div class="container hero">
                <div class="customer-support">
                    <i class="fa-solid fa-headset"></i>
                    <div class="content-customer-support">
                        <span class="text">Soporte al cliente</span>
                        <span class="number">+52_9984669723</span>
                    </div>
                </div>
                <div class="container-logo">
                    <a href="index.php"><img src="img/UNIFEAST SIN COMEDOR.png" alt=""></a>
                </div>
                <div class="container-user">
                    <a href="iniciodesecion.php"><i class="fa-solid fa-user"></i></a>
                    <a href="mochila.php"><i class="fa-solid fa-basket-shopping"></i></a>
                    <div class="content-shopping-cart">
                        <span class="text">Mochila</span>
                        <span class="number">(0)</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-navbar">
            <nav class="navbar container">
                <i class="fa-solid fa-bars"></i>
                <ul class="menu">
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="index.php#trayectoria">Trayectoria</a></li>
                    <li><a href="index.php#conocenos">Conocenos</a></li>
                    <li><a href="index.php#cafeterias">Cafeterias</a></li>
                </ul>
                <div class="container-details-product">
                    <div class="form-group">
                        <select name="category" id="category">
                            <option disabled selected value="">Categoria</option>
                            <option value="rojo">Postre</option>
                            <option value="blanco">Comida</option>
                            <option value="beige">Desayuno</option>
                        </select>
                    </div>
                    <form class="search-form">
                        <input type="search" placeholder="Buscar...">
                        <button class="btn-search">
                            <i class="fa-solid fa-magnifying-glass"></i>
                        </button>
                    </form>
                </div>
            </nav>
        </div>
    </header>
    <section class="container">
        <div class="titulos">
            <h2>Mis Pedidos</h2>
        </div>
        <div class="conjunto-pedidos">
            <?php if ($result->num_rows > 0): ?>
                <table class="tabla-pedidos">
                    <thead>
                        <tr>
                            <th>ID Pedido</th>
                            <th>Total</th>
                            <th>Estado</th>
                            <th>Fecha</th>
                            <th>Productos</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo $row['id']; ?></td>
                                <td><?php echo $row['total']; ?></td>
                                <td><?php echo $row['estado']; ?></td>
                                <td><?php echo $row['created_at']; ?></td>
                                <td><?php echo $row['productos']; ?></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p>No tienes pedidos.</p>
            <?php endif; ?>
        </div>
    </section>
    <footer class="footer">
        <div class="container container-footer">
            <div class="menu-footer">
                <div class="contact-info">
                    <p class="title-footer">Información de Contacto</p>
                    <ul>
                        <li>Dirección: Carretera Federal 307, Blvd. Luis Donaldo Colosio, 77560 Cancún, Q.R.</li>
                        <li>Teléfono: +52_9984669723</li>
                        <li>Email: <a href="https://mail.google.com/mail/u/0/#inbox?compose=new" target="_blank">unifeast_support@gmail.com</a></li>
                    </ul>
                    <div class="social-icons">
                        <span class="facebook">
                            <a href="https://www.facebook.com/profile.php?id=61561620386229&mibextid=ZbWKwL" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                        </span>
                        <span class="twitter">
                            <a href="https://twitter.com/UniFeast?t=Mrmv00pWofrsgAbAjmmUlQ&s=09" target="_blank"><i class="fa-brands fa-twitter"></i></a>
                        </span>
                        <span class="instagram">
                            <a href="https://www.instagram.com/unifeastoficial" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                        </span>
                    </div>
                </div>
                <div class="information">
                    <p class="title-footer">Información</p>
                    <ul>
                        <li><a href="contactanos-uni.php">Contactanos</a></li>
                        <li><a href="ayuda.php">Ayuda</a></li>
                    </ul>
                </div>
                <div class="information">
                    <p class="title-footer">Información</p>
                    <ul>
                        <li><a href="aviso-de-priv.php">Aviso de privacidad</a></li>
                        <li><a href="terminos-condiciones.php">Términos y condiciones</a></li>
                        <li><a href="mapa-de-sitio.php">Mapa de sitio</a></li>
                    </ul>
                </div>
            </div>
            <div class="copyright">
                <p>Derechos Reservados por Alexis Yah y Rodrigo Cetz &copy; 2024</p>
            </div>
        </div>
    </footer>
</body>
</html>
<?php
$stmt->close();
?>
