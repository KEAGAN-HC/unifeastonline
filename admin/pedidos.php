<?php
require_once "../config/conexion.php";

// Actualizar estado de la orden
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['orden_id'])) {
    $orden_id = $_POST['orden_id'];
    $nuevo_estado = 'Listo para recoger';

    $sql = "UPDATE ordenes SET estado = ? WHERE id = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("si", $nuevo_estado, $orden_id);
    $stmt->execute();
}

// Obtener las órdenes pendientes
$sql = "SELECT ordenes.id AS orden_id, ordenes.estado, clientes.nombre AS cliente_nombre, productos.nombre AS producto_nombre, orden_items.cantidad, productos.precio_normal
        FROM ordenes
        INNER JOIN clientes ON ordenes.cliente_id = clientes.id
        INNER JOIN orden_items ON ordenes.id = orden_items.orden_id
        INNER JOIN productos ON orden_items.producto_id = productos.id
        WHERE ordenes.estado = 'Pendiente'";
$result = $conexion->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedidos Pendientes</title>
    <link rel="stylesheet" href="path/to/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Pedidos Pendientes</h1>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID Pedido</th>
                    <th>Cliente</th>
                    <th>Producto</th>
                    <th>Cantidad</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['orden_id']; ?></td>
                        <td><?php echo $row['cliente_nombre']; ?></td>
                        <td><?php echo $row['producto_nombre']; ?></td>
                        <td><?php echo $row['cantidad']; ?></td>
                        <td><?php echo $row['precio_normal']; ?></td>
                        <td><?php echo $row['estado']; ?></td>
                        <td>
                            <form method="post" action="">
                                <input type="hidden" name="orden_id" value="<?php echo $row['orden_id']; ?>">
                                <button type="submit" class="btn btn-success">Listo para recoger</button>
                            </form>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>
</html>
