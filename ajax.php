<?php
require_once "config/conexion.php";

if (isset($_POST)) {
    if ($_POST['action'] == 'buscar') {
        $array['datos'] = array();
        $total = 0;
        for ($i = 0; $i < count($_POST['data']); $i++) {
            $id = $_POST['data'][$i]['id'];
            $query = mysqli_query($conexion, "SELECT * FROM productos WHERE id = $id");
            $result = mysqli_fetch_assoc($query);
            $data['id'] = $result['id'];
            $data['precio'] = $result['precio_rebajado'];
            $data['nombre'] = $result['nombre'];
            $data['cantidad'] = $_POST['data'][$i]['cantidad']; // Añadir cantidad del producto
            $total += $result['precio_rebajado'] * $data['cantidad'];
            array_push($array['datos'], $data);
        }
        $array['total'] = $total;
        echo json_encode($array);
        die();
    }

if ($_POST['action'] == 'crear_orden') {
    $cliente_id = $_POST['cliente_id'];
    $total = $_POST['total'];
    $productos = json_decode($_POST['productos'], true); 

    // Insertar la orden en la tabla 'ordenes'
     $sql = "INSERT INTO ordenes (cliente_id, total, estado, created_at) VALUES (?, ?, 'Pendiente', NOW())";
     $stmt = $conexion->prepare($sql);
    $stmt->bind_param("id", $cliente_id, $total);

    if ($stmt->execute()) {
        $orden_id = $stmt->insert_id; 

    
        foreach ($productos as $producto) {
            $producto_id = $producto['id'];
            $cantidad = $producto['cantidad'];
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
    die();
  }
}
?>
