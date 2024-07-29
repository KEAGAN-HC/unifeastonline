<?php
require_once "config/conexion.php";
require_once "config/config.php";

session_start();
$cliente_id = $_SESSION['user_id']; // Asegúrate de que la sesión tiene almacenada la ID del cliente
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>UniFeast</title>
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
            <span class="number">(0)</span>
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
        </ul>av class="navbar container">
        

        <form class="search-form">
          <input type="search" placeholder="Buscar..." />
          <button class="btn-search">
            <i class="fa-solid fa-magnifying-glass"></i>
          </button>
        </form>
      </nav>
    </div>
  </header>

  <section class="mochila-container">
    <h2 class="">Mochila</h2>
    <div class="products-mochila">
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>#</th>
              <th>Producto</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Sub Total</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody id="tblCarrito">
            <!-- Aquí se llenará dinámicamente con los productos del carrito -->
          </tbody>
        </table>
      </div>
    </div>
    <div class="summary">
      <h4>Total a Pagar: <span id="total_pagar">0.00</span></h4>
      <div id="paypal-button-container"></div>
      <button class="btn btn-warning" type="button" id="btnVaciar">Vaciar Carrito</button>
    </div>
    <aside class="suggestions">
      <h3>Te podría interesar</h3>
      <div class="suggestion-item">
        <a href="producto.html"><img src="img/enchiladas.jpg" alt="Imagen del Producto"></a>
        <p>Enchiladas Verdes <br>Precio: $50</p>
      </div>
      <div class="suggestion-item">
        <a href="producto.html"><img src="img/empanada.jpg" alt="Imagen del Producto"></a>
        <p>Empanada <br>Precio: $30</p>
      </div>
      <div class="suggestion-item">
        <a href="producto.html"><img src="img/enmolada.jpg" alt="Imagen del Producto"></a>
        <p>Enmolada <br>Precio: $40</p>
      </div>
    </aside>
  </section>
  
  <!-- Bootstrap core JS-->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Core theme JS-->
  <script src="assets/js/jquery-3.6.0.min.js"></script>
  <script src="https://www.paypal.com/sdk/js?client-id=ATv6AeJlxiQ3elbSNlHUZ5cKF4gjIpuU7Q-gU0LeCCNAVhOlT8jjNkkpNNLZK7J_NsVYT8Mysbh2xaKj<?php echo CLIENT_ID; ?>&locale=<?php echo LOCALE; ?>"></script>
  <script src="assets/js/scripts.js"></script>
  <script>
    $(document).ready(function() {
      mostrarCarrito();
    });

    function mostrarCarrito() {
      if (localStorage.getItem("productos") != null) {
        let array = JSON.parse(localStorage.getItem('productos'));
        if (array.length > 0) {
          $.ajax({
            url: 'ajax.php',
            type: 'POST',
            async: true,
            data: {
              action: 'buscar',
              data: array
            },
            success: function(response) {
              console.log(response);
              const res = JSON.parse(response);
              let html = '';
              res.datos.forEach((element, index) => {
                html += `
                  <tr>
                    <td>${element.id}</td>
                    <td>${element.nombre}</td>
                    <td>${element.precio}</td>
                    <td>1</td>
                    <td>${element.precio}</td>
                    <td><button class="btn btn-danger" onclick="eliminarProducto(${index})">Eliminar</button></td>
                  </tr>
                `;
              });
              $('#tblCarrito').html(html);
              $('#total_pagar').text(res.total);
              paypal.Buttons({
                style: {
                  color: 'blue',
                  shape: 'pill',
                  label: 'pay'
                },
                createOrder: function(data, actions) {
                  return actions.order.create({
                    purchase_units: [{
                      amount: {
                        value: res.total
                      }
                    }]
                  });
                },
                onApprove: function(data, actions) {
                  return actions.order.capture().then(function(details) {
                    // Guardar la orden en la base de datos
                    $.ajax({
                      url: 'procesar_orden.php',
                      type: 'POST',
                      data: {
                        action: 'crear_orden',
                        cliente_id: clienteId, // Reemplazar con el ID real del cliente
                        total: res.total,
                        productos: JSON.stringify(array)
                      },
                      success: function(response) {
                        var res = JSON.parse(response);
                        if (res.status == 'success') {
                          alert('Orden creada exitosamente');
                          localStorage.removeItem('productos');
                          mostrarCarrito();
                          window.location.href = 'order_success.php';
                        } else {
                          alert('Error al crear la orden: ' + res.message);
                        }
                      },
                      error: function(error) {
                        console.log(error);
                      }
                    });
                  });
                }
              }).render('#paypal-button-container');
            },
            error: function(error) {
              console.log(error);
            }
          });
        }
      }
    }

    function eliminarProducto(index) {
      let productos = JSON.parse(localStorage.getItem('productos')) || [];
      productos.splice(index, 1); // Elimina el producto del array
      localStorage.setItem('productos', JSON.stringify(productos)); // Actualiza el localStorage
      if (productos.length === 0) {
        location.reload(); // Recarga la página si el carrito está vacío
      } else {
        mostrarCarrito(); // Vuelve a mostrar el carrito actualizado
      }
    }

    $('#btnVaciar').click(function() {
      localStorage.removeItem('productos');
      location.reload(); // Recarga la página después de vaciar el carrito
    });
    
  </script>
</body>

</html>
