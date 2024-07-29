<?php
require_once "config/conexion.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ($_POST['action'] == 'crear_orden') {
        $cliente_id = $_POST['cliente_id'];
        $total = $_POST['total'];
        $productos = json_decode($_POST['productos'], true);

        // Insertar la orden en la tabla 'ordenes'
        $sql = "INSERT INTO ordenes (cliente_id, total) VALUES (?, ?)";
        $stmt = $conexion->prepare($sql);
        $stmt->bind_param("id", $cliente_id, $total);

        if ($stmt->execute()) {
            $orden_id = $stmt->insert_id;

            // Insertar cada producto en la tabla 'orden_items'
            foreach ($productos as $producto) {
                $producto_id = $producto['id'];
                $cantidad = 1; // Suponemos cantidad 1 por defecto
                $precio = $producto['precio'];

                $sql_item = "INSERT INTO orden_items (orden_id, producto_id, cantidad, precio) VALUES (?, ?, ?, ?)";
                $stmt_item = $conexion->prepare($sql_item);
                $stmt_item->bind_param("iiid", $orden_id, $producto_id, $cantidad, $precio);
                $stmt_item->execute();
            }

            echo json_encode(['status' => 'success', 'message' => 'Orden creada exitosamente']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error al crear la orden']);
        }
    }
}
?>
