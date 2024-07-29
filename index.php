<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UNIFEAST</title>
  <link rel="stylesheet" href="assets/css/styles.css" />
  <link rel="stylesheet" href="assets/css/normalize.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link rel="shortcut icon" href="/img/favicon-32x32.png">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900&display=swap" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/d139bfcb49.js" crossorigin="anonymous"></script>
  <style>
    .search-results {
        position: absolute;
        background: white;
        border: 1px solid #ccc;
        max-height: 200px;
        overflow-y: auto;
        width: 100%;
        z-index: 1000;
    }

    .search-result-item {
        display: flex;
        align-items: center;
        padding: 5px 10px;
        border-bottom: 1px solid #eee;
    }

    .search-result-item a {
        display: flex;
        align-items: center;
        text-decoration: none;
        color: black;
        width: 100%;
    }

    .search-result-item a:hover {
        background-color: #f5f5f5;
    }
  </style>
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
          <?php if (isset($_SESSION['user_id'])): ?>
            <a href="perfil.php"><i class="fa-solid fa-user"></i></a>
            <a href="carrito.php"><i class="fa-solid fa-basket-shopping"></i></a>
          <?php else: ?>
            <a href="iniciosesion.php"><i class="fa-solid fa-user"></i></a>
            <a href="iniciosesion.php"><i class="fa-solid fa-basket-shopping"></i></a>
          <?php endif; ?>
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
          <li><a href="#trayectoria">Trayectoria</a></li>
          <li><a href="#Conocenos">Conocenos</a></li>
        </ul>

        <div class="container-details-product">
          <form class="search-form" id="search-form">
            <input type="search" placeholder="Buscar..." id="search" autocomplete="off" />
            <button class="btn-search" type="submit">
                <i class="fa-solid fa-magnifying-glass"></i>
            </button>
            <div id="search-results" class="search-results"></div>
          </form>
        </div>
      </nav>
    </div>
  </header>

  <main class="main-content">
    <section class="welcom">
      <div class="contet-welcom">
        <p>Bienvenido a UniFeast</p>
        <h2>Pide desde <br />clases, recoge sin filas</h2>
        <a href="#como-funciona">Como funciona</a>
      </div>
    </section>

    <section class="container" id="cafeterias">
      <div class="titulos">
        <h2>Cafeterias</h2>
      </div>
      <div id="slider">
        <input type="radio" name="slider" id="slide1" checked />
        <input type="radio" name="slider" id="slide2" />
        <input type="radio" name="slider" id="slide3" />
        <input type="radio" name="slider" id="slide4" />
        <div id="slides">
          <div id="overflow">
            <div class="inner">
              <div class="slide slide_1">
                <div class="slide-content">
                  <h2>Cafeteria 1</h2>
                  <p>Contenido 1</p>
                  <a href="menu_cafeteria1.php">Ver Menu</a>
                </div>
              </div>
              <div class="slide slide_2">
                <div class="slide-content">
                  <h2>Cafeteria 2</h2>
                  <p>Contenido 2</p>
                  <a href="menu_cafeteria2.php">Ver Menu</a>
                </div>
              </div>
              <div class="slide slide_3">
                <div class="slide-content">
                  <h2>Cafeteria 3</h2>
                  <p>Contenido 3</p>
                  <a href="menu_cafeteria3.php">Ver Menu</a>
                </div>
              </div>
              <div class="slide slide_4">
                <div class="slide-content">
                  <h2>Cafeteria 4</h2>
                  <p>Contenido 4</p>
                  <a href="menu_cafeteria4.php">Ver Menu</a>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div id="controls">
          <label for="slide1"></label>
          <label for="slide2"></label>
          <label for="slide3"></label>
          <label for="slide4"></label>
        </div>
        <div id="bullets">
          <label for="slide1"></label>
          <label for="slide2"></label>
          <label for="slide3"></label>
          <label for="slide4"></label>
        </div>
      </div>
    </section>

    <section class="container" id="como-funciona">
      <h2 class="titulos">Como Funciona</h2>
      <div class="conjunto-pasos">
        <div class="pasos">
          <img src="img/enchiladas.jpg" alt="">
          <h3>Busca tu comida favorita</h3>
          <p>Busca la comida que mas se antoje en ese momento</p>
        </div>
        <div class="pasos">
          <img src="img/hands-2178566_1280.jpg" alt="">
          <h3>Ordena en la pagina</h3>
          <p>Agrega las comidas de una sola cafeteria y ordenalas pagando en efectivo o en tarjeta</p>
        </div>
        <div class="pasos">
          <img src="img/didi_food_0.jpg_393767599.jpg" alt="">
          <h3>Recoge en la cafeteria asignada</h3>
          <p>Recoge tu pedido en la cafeteria asignada y disfruta de tu pedido</p>
        </div>
      </div>
    </section>

    <section class="container " id="trayectoria">
      <div>
        <h2 class="titulo-trayectoria">Trayectoria</h2>
      </div>
      <div class="trayectoria-cont trayec">
        <p>UniFeast surgió a partir de nuestra experiencia como estudiantes, enfrentando las largas filas y la espera
          para comprar comida en la Universidad Tecnológica (UT). Muchas veces, los alimentos no tienen la calidad o
          presentación esperada. Por eso, hemos creado esta aplicación web para facilitar una compra más rápida y
          eficiente. Simplemente entra en la app, regístrate y pide tu comida favorita de la cafetería, evitando así las
          largas filas. ¡Disfruta de una experiencia de compra mucho más cómoda y rápida con UniFeast!</p>
        <video controls autoplay loop muted poster="img/alumno.mp4">
          <source src="iimg/alumno.mp4" type="video/mp4">
          <source src="img/alumno.mp4" type="video/webm">
          <source src="img/alumno.mp4" type="video/ogg">
        </video>
      </div>
    </section>

    <section class="container" id="Conocenos">
      <h2 class="titulos">Conocenos</h2>
      <div class="conjunto-creadores">
        <div class="creador">
          <a href="https://www.instagram.com/alexzs_yh/?hl=es-la" target="_blank"><img src="img/alexisyah.jpeg" alt=""></a>
          <h3>Alexis Yah</h3>
        </div>
        <div class="creador">
          <a href="https://www.instagram.com/al3x_hc/?hl=es-la" target="_blank"><img src="img/cetzherrera.jpeg" alt=""></a>
          <h3>Rodrigo Herrera</h3>
        </div>
      </div>
    </section>
  </main>

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

  <script>
document.getElementById('search-form').addEventListener('submit', function(event) {
    event.preventDefault(); // Evitar el envío del formulario
});

document.getElementById('search').addEventListener('input', function() {
    var query = this.value;
    if (query != "") {
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'buscar_productos.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                document.getElementById('search-results').innerHTML = xhr.responseText;
            }
        }
        xhr.send('query=' + query);
    } else {
        document.getElementById('search-results').innerHTML = '';
    }
});
</script>
</body>
</html>
