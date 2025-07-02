<?php
require_once "main.php";
require_once "../inc/session_start.php";

$usuario_id = isset($_SESSION['id']) ? $_SESSION['id'] : null;

if (!$usuario_id) {
    echo "Error: sesión de usuario no disponible.";
    exit;
}

// Verificar si hay datos recibidos
if (!isset($_POST['venta_detalle'])) {
    echo "No se recibieron datos.";
    exit;
}

$detalle = json_decode($_POST['venta_detalle'], true);

try {
    $db = conexion();
    $db->beginTransaction();

    $total = 0;

    // Calcular total (ya incluye IGV)
    foreach ($detalle as $item) {
        $producto_id = $item['id'];
        $cantidad = $item['cantidad'];

        $stmt = $db->prepare("SELECT producto_precio, producto_stock FROM producto WHERE producto_id = ?");
        $stmt->execute([$producto_id]);
        $prod = $stmt->fetch();

        if (!$prod || $prod['producto_stock'] < $cantidad) {
            throw new Exception("Stock insuficiente para producto ID $producto_id");
        }

        $precio = $prod['producto_precio'];
        $total += $precio * $cantidad;
    }

    $subtotal = $total / 1.18;
    $igv = $total - $subtotal;

    // Insertar venta principal con subtotal, igv y total
    $stmt = $db->prepare("INSERT INTO venta (usuario_id, fecha, subtotal, igv, total) VALUES (?, NOW(), ?, ?, ?)");
    $stmt->execute([$usuario_id, $subtotal, $igv, $total]);
    $venta_id = $db->lastInsertId();

    // Insertar cada producto como detalle y descontar stock
    foreach ($detalle as $item) {
        $producto_id = $item['id'];
        $cantidad = $item['cantidad'];

        $stmt = $db->prepare("SELECT producto_precio FROM producto WHERE producto_id = ?");
        $stmt->execute([$producto_id]);
        $prod = $stmt->fetch();
        $precio = $prod['producto_precio'];

        $stmt = $db->prepare("INSERT INTO detalle_venta (venta_id, producto_id, cantidad, precio_unitario) VALUES (?, ?, ?, ?)");
        $stmt->execute([$venta_id, $producto_id, $cantidad, $precio]);

        $stmt = $db->prepare("UPDATE producto SET producto_stock = producto_stock - ? WHERE producto_id = ?");
        $stmt->execute([$cantidad, $producto_id]);
    }

    $db->commit();
    header("Location: ../index.php?vista=venta_lista&mensaje=Venta+registrada");
} catch (Exception $e) {
    $db->rollBack();
    echo "Error: " . $e->getMessage();
}


