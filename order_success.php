<!DOCTYPE html>
<html lang="en">
<head>
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UniFeast</title>

  <style>
    .gracias-compra {
      font-size: 8rem; /* Tamaño de fuente grande para el título */
      font-weight: bold; /* Negrita */
      margin-bottom: 20px; /* Espaciado inferior */
      color: orange;
      margin-left: 2rem;
    }

    .orden-procesada {
      font-size: 2.5rem; /* Tamaño de fuente grande para el párrafo */
      margin-bottom: 20px; /* Espaciado inferior */
      margin-left: 2rem;
    }

    .ir-mis-pedidos {
      font-size: 2em; /* Tamaño de fuente más grande para el enlace */
      text-decoration: none; /* Quitar subrayado del enlace */
      color: blue; /* Color del enlace */
      margin-left: 2rem;
      margin-top: 2rem;
    }

    .ir-mis-pedidos:hover {
      text-decoration: underline; /* Subrayado al pasar el cursor */
    }
  </style>
  <script>
            var clienteId = <?php echo json_encode($cliente_id); ?>;
  </script>
  <link rel="stylesheet" href="assets/css/mochilastyles.css" />
  <link rel="stylesheet" href="assets/css/normalize.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="shortcut icon" href="/img/favicon-32x32.png">
  <link
    href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
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
          <a href="perfil.php"><i class="fa-solid fa-user"></i></a>
          <a href="carrito.php"><i class="fa-solid fa-basket-shopping"></i></a>
          <div class="content-shopping-cart">
            <span class="text">Mochila</span>
            <span class="number"></span>
          </div>
        </div>
      </div>
    </div>

    <div class="container-navbar">
      <n<i class="fa-solid fa-bars"></i>
        <ul class="menu">
          <li><a href="index.php">Inicio</a></li>
          <li><a href="index.php#trayectoria">Trayectoria</a></li>
          <li><a href="index.php#conocenos">Conocenos</a></li>
          <li><a href="index.php#cafeterias">Cafeterias</a></li>
        </form>
      </nav>
    </div>
  </header>

</head>
<body>
  <h1 class="gracias-compra">¡Gracias por tu compra!</h1>
  <p class="orden-procesada">Tu orden ha sido procesada exitosamente. Podrás consultar el estado en "Mis pedidos".</p>
  <a href="consultar_pedidos.php" class="ir-mis-pedidos">Ir a Mis pedidos</a>

  <footer class="footer">
    <div class="container container-footer">
      <div class="menu-footer">
        <div class="contact-info">
          <p class="title-footer">Información de Contacto</p>
          <ul>
            <li>Dirección: Carretera Federal 307, Blvd. Luis Donaldo Colosio, 77560 Cancún, Q.R.</li>
            <li>Teléfono: +52_9984669723</li>
            <li>EmaiL: <a href="https://mail.google.com/mail/u/0/#inbox?compose=new" target="_blank">unifeast_support@gmail.com</li></a>
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
</body>
</html>