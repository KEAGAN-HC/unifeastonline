<?php
require_once "config/conexion.php"; // Asegúrate de que este archivo tenga la configuración correcta

// Obtener las categorías desde la base de datos
$categoriasQuery = mysqli_query($conexion, "SELECT id, categoria FROM categorias");

// Verificar si se ha seleccionado una categoría
$categoriaSeleccionada = isset($_GET['categoria']) ? $_GET['categoria'] : '';

// Consulta SQL para obtener los productos filtrados por la categoría seleccionada (si existe)
$sqlProductos = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria";
if (!empty($categoriaSeleccionada)) {
    $sqlProductos .= " WHERE p.id_categoria = $categoriaSeleccionada";
}
$queryProductos = mysqli_query($conexion, $sqlProductos);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UniFeast</title>
  <link href="assets/css/styles.css" rel="stylesheet" />
  <link href="assets/css/normalize.css" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="shortcut icon" href="/img/favicon-32x32.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet" />
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
            <select name="category" id="category" onchange="filtrarPorCategoria(this.value)">
              <option disabled selected value="">Categoria</option>
              <?php while ($categoria = mysqli_fetch_assoc($categoriasQuery)) { ?>
                  <option value="<?php echo $categoria['id']; ?>" <?php echo $categoriaSeleccionada == $categoria['id'] ? 'selected' : ''; ?>>
                      <?php echo $categoria['categoria']; ?>
                  </option>
              <?php } ?>
            </select>
          </div>

          <form class="search-form" method="GET" action="">
            <input type="search" name="search" placeholder="Buscar..." />
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
      <h2>Menu Cafeteria 1</h2>
    </div>
    <div class="conjunto-productos">
      <?php
      $result = mysqli_num_rows($queryProductos);
      if ($result > 0) {
          while ($data = mysqli_fetch_assoc($queryProductos)) { ?>
              <div class="producto">
                  <a href="producto.php?id=<?php echo $data['id']; ?>"><img src="assets/img/<?php echo $data['imagen']; ?>" alt=""></a>
                  <h3><?php echo $data['nombre']; ?></h3>
                  <p><?php echo $data['precio_rebajado']; ?> MXN</p>
                  <a href="producto.php?id=<?php echo $data['id']; ?>" class="btn-product">Ver más</a>
              </div>
      <?php }
      } else { ?>
          <p>No hay productos disponibles en esta categoría.</p>
      <?php } ?>
    </div>
  </section>

  <footer class="footer">
    <div class="container container-footer">
      <div class="menu-footer">
        <div class="contact-info">
          <p class="title-footer">Información de Contacto</p>
          <ul>
            <li>
              Dirección: Carretera Federal 307, Blvd. Luis Donaldo Colosio, 77560 Cancún, Q.R.
            </li>
            <li>Teléfono: +52_9984669723</li>
            <li>EmaiL: <a href="https://mail.google.com/mail/u/0/#inbox?compose=new" target="_blank">unifeast_support@gmail.com</a></li>
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
        <p>
          Derechos Reservados por Alexis Yah y Rodrigo Cetz &copy; 2024
        </p>
      </div>
    </div>
  </footer>
  <script>
    function filtrarPorCategoria(categoriaId) {
      window.location.href = "menu_cafeteria1.php?categoria=" + categoriaId;
    }
  </script>
</body>
</html>
