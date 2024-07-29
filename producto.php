<?php
require_once "config/conexion.php"; // Asegúrate de que este archivo tenga la configuración correcta

if (isset($_GET['id'])) {
    $idProducto = $_GET['id'];

    // Consulta SQL ajustada a tu estructura de base de datos
    $query = mysqli_query($conexion, "SELECT id, nombre, descripcion, precio_rebajado, imagen FROM productos WHERE id = $idProducto");
    
    $data = mysqli_fetch_assoc($query);

    if ($data) { ?>
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8" />
            <meta name="viewport" content="width=device-width, initial-scale=1.0" />
            <title>UniFeast</title>
            <link rel="stylesheet" href="assets/css/styles.css" />
            <link rel="stylesheet" href="assets/css/normalize.css" />
            <link rel="preconnect" href="https://fonts.googleapis.com" />
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
            <link rel="shortcut icon" href="/img/favicon-32x32.png">
            <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet" />
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
                            <a href="index.php"><img src="img/UNIFEAST SIN COMEDOR.png" alt="" /></a>
                        </div>
                        <div class="container-user">
                            <a href="iniciodesecion.html"><i class="fa-solid fa-user"></i></a>
                            <a href="carrito.php"><i class="fa-solid fa-basket-shopping"></i></a>
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
                            <li><a href="index.html">Inicio</a></li>
                            <li><a href="index.html#trayectoria">Trayectoria</a></li>
                            <li><a href="index.html#conocenos">Conocenos</a></li>
                            <li><a href="javascript:history.back()">Menu</a></li>
                            <li><a href="index.html#cafeterias">Cafeterias</a></li>
                        </ul>
                        <div class="container-details-product">
                            <div class="form-group">
                                <select name="category" id="category">
                                    <option disabled selected value="">
                                        Categoria
                                    </option>
                                    <option value="rojo">Postre</option>
                                    <option value="blanco">Comida</option>
                                    <option value="beige">Desayuno</option>
                                </select>
                            </div>
                            <form class="search-form">
                                <input type="search" placeholder="Buscar..." />
                                <button class="btn-search">
                                    <i class="fa-solid fa-magnifying-glass"></i>
                                </button>
                            </form>
                        </div>
                    </nav>
                </div>
            </header>
            <main class="container">
                <h2 class="titulo-trayectoria"><?php echo $data['nombre']; ?></h2>
                <div class="product">
                    <div class="container-img">
                        <img src="assets/img/<?php echo $data['imagen']; ?>" alt="imagen-producto" />
                    </div>
                    <div class="container-info-product">
                        <div class="container-price">
                            <span>$<?php echo $data['precio_rebajado']; ?></span>
                        </div>
                        <div class="container-description">
                            <div class="title-description">
                                <h3>Descripción</h3>
                            </div>
                            <div class="text-description">
                                <p><?php echo $data['descripcion']; ?></p>
                            </div>
                        </div>
                        <div>
                            <h3>Editar</h3>
                            <input type="text" id="cantidadProducto" value="1">
                        </div>
                        <div>
                            <button onclick="agregarProducto(<?php echo $data['id']; ?>, '<?php echo $data['nombre']; ?>', <?php echo $data['precio_rebajado']; ?>, '<?php echo $data['imagen']; ?>')">Agregar</button>
                            <button>Pagar</button>
                        </div>
                    </div>
                </div>
            </main>
            <footer class="footer">
                <div class="container container-footer">
                    <div class="menu-footer">
                        <div class="contact-info">
                            <p class="title-footer">Información de Contacto</p>
                            <ul>
                                <li>Dirección: Carretera Federal 307, Blvd. Luis Donaldo Colosio, 77560 Cancún, Q.R.</li>
                                <li>Teléfono: +52_9984669723</li>
                                <li>Email: <a href="mailto:unifeast_support@gmail.com" target="_blank">unifeast_support@gmail.com</a></li>
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
                                <li><a href="contactanos-uni.html">Contactanos</a></li>
                                <li><a href="ayuda.html">Ayuda</a></li>
                            </ul>
                        </div>
                        <div class="information">
                            <p class="title-footer">Información</p>
                            <ul>
                                <li><a href="aviso-de-priv.html">Aviso de privacidad</a></li>
                                <li><a href="terminos-condiciones.html">Términos y condiciones</a></li>
                                <li><a href="mapa-de-sitio.html">Mapa de sitio</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="copyright">
                        <p>Derechos Reservados por Alexis Yah y Rodrigo Cetz &copy; 2024</p>
                    </div>
                </div>
            </footer>
            <script>
                function agregarProducto(id, nombre, precio, imagen) {
                    let cantidad = parseInt(document.getElementById('cantidadProducto').value);
                    if (isNaN(cantidad) || cantidad <= 0) {
                        alert("Por favor, ingrese una cantidad válida.");
                        return;
                    }

                    let producto = {
                        id: id,
                        nombre: nombre,
                        precio: precio,
                        imagen: imagen,
                        cantidad: cantidad
                    };

                    let productos = JSON.parse(localStorage.getItem('productos')) || [];
                    
                    let index = productos.findIndex(p => p.id === id);
                    if (index > -1) {
                        productos[index].cantidad += cantidad;
                    } else {
                        productos.push(producto);
                    }

                    localStorage.setItem('productos', JSON.stringify(productos));
                    alert('Producto agregado a la mochila.');
                }
            </script>
        </body>
        </html>

    <?php } else {
        echo "Producto no encontrado.";
    }
} else {
    echo "ID de producto no proporcionado.";
}
?>
