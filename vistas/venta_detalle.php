<?php
require_once "./php/main.php";

if (!isset($_GET['id'])) {
    echo "ID de venta no especificado.";
    exit;
}

$venta_id = $_GET['id'];
$db = conexion();

$stmt = $db->prepare("SELECT v.*, u.usuario_nombre, u.usuario_apellido 
                      FROM venta v 
                      LEFT JOIN usuario u ON v.usuario_id = u.usuario_id 
                      WHERE v.venta_id = ?");
$stmt->execute([$venta_id]);
$venta = $stmt->fetch();

if (!$venta) {
    echo "Venta no encontrada.";
    exit;
}

$stmt = $db->prepare("SELECT dv.*, p.producto_nombre 
                      FROM detalle_venta dv 
                      JOIN producto p ON dv.producto_id = p.producto_id 
                      WHERE dv.venta_id = ?");
$stmt->execute([$venta_id]);
$detalles = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Detalle de Venta #<?= $venta_id ?></title>
  <link rel="stylesheet" href="./css/bulma.min.css">
  <style>
    @media print {
      body * {
        visibility: hidden;
      }
      #comprobante, #comprobante * {
        visibility: visible;
      }
      #comprobante {
        position: absolute;
        left: 0;
        top: 0;
        width: 100%;
      }
      button {
        display: none !important;
      }
    }
  </style>
</head>
<body>
  <section class="section">
    <div class="container" id="comprobante">
      <div class="box has-text-centered">
        <h2 class="title is-4">🧾 Detalle de la Venta #<?= $venta_id ?></h2>
        <p><strong>Fecha:</strong> <?= $venta['fecha'] ?></p>
        <p><strong>Atendido por:</strong> <?= $venta['usuario_nombre'] . " " . $venta['usuario_apellido'] ?></p>
        <p><strong>Subtotal:</strong> S/ <?= number_format($venta['subtotal'], 2) ?></p>
        <p><strong>IGV (18%):</strong> S/ <?= number_format($venta['igv'], 2) ?></p>
        <p><strong>Total:</strong> S/ <?= number_format($venta['total'], 2) ?></p>
      </div>

      <div class="table-container">
        <table class="table is-fullwidth is-bordered is-striped has-text-centered">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Precio Unitario</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($detalles as $item): ?>
            <tr>
              <td><?= $item['producto_nombre'] ?></td>
              <td>S/ <?= number_format($item['precio_unitario'], 2) ?></td>
              <td><?= $item['cantidad'] ?></td>
              <td>S/ <?= number_format($item['precio_unitario'] * $item['cantidad'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
          </tbody>
        </table>
        <!-- Agradecimiento y logo -->
    <div style="text-align: center; margin-top: 40px;">
        <p><strong>¡Gracias por su compra!</strong></p>
        <img src="./img/logo.png" alt="Boleta" style="max-width: 200px; margin-top: 10px;">
    </div>

    <!-- Botón de impresión -->
    <div class="text-center mt-4" style="text-align: center;">
    </div>
      </div>

      <!-- Botón solo visible en pantalla -->
      <div class="has-text-centered mt-5">
        <button class="button is-primary" onclick="window.print()">
          🖨️ Imprimir Comprobante
        </button>
      </div>
    </div>
  </section>
</body>
</html>



