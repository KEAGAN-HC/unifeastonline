<?php
require_once "config/conexion.php";

if (isset($_POST['query'])) {
    $query = $_POST['query'];

    if (empty($query)) {
        $sqlProductos = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria";
    } else {
        $sqlProductos = "SELECT p.*, c.categoria FROM productos p INNER JOIN categorias c ON c.id = p.id_categoria WHERE p.nombre LIKE '%$query%' OR p.descripcion LIKE '%$query%'";
    }

    $queryProductos = mysqli_query($conexion, $sqlProductos);

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
        <p>No hay productos disponibles.</p>
    <?php }
}
?>
