<?php
require_once "./php/main.php";

$conexion = conexion();

// Obtener ventas con nombre de usuario
$sql = "SELECT v.venta_id, v.fecha, v.total, u.usuario_nombre, u.usuario_apellido
        FROM venta v
        LEFT JOIN usuario u ON v.usuario_id = u.usuario_id
        ORDER BY v.venta_id DESC";

$ventas = $conexion->query($sql)->fetchAll();
?>

<div class="mb-4">
  <a href="./php/reporte_total_ventas_pdf.php"  target="_blank">
  
    <button type="submit" class="button is-link">Generar PDF total</button>
  </a>
</div>

<form action="./php/reporte_ventas_pdf.php" method="GET" class="box mt-4" target="_blank">
  <div class="field is-horizontal">     
    <div class="field-label is-normal">
      <label class="label">Desde</label>
    </div>
    <div class="field-body">
      <div class="field">
        <p class="control">
          <input class="input" type="date" name="desde" required>
        </p>
      </div>
    </div>
  </div>

  <div class="field is-horizontal">
    <div class="field-label is-normal">
      <label class="label">Hasta</label>
    </div>
    <div class="field-body">
      <div class="field">
        <p class="control">
          <input class="input" type="date" name="hasta" required>
        </p>
      </div>
    </div>
  </div>

  <div class="field is-grouped">
    <div class="control">
      <button type="submit" class="button is-link">Generar PDF</button>
    </div>
  </div>
</form>


<div class="container mt-4">
    <h2 class="mb-4">📋 Lista de Ventas</h2>

    <?php if (isset($_GET['mensaje'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_GET['mensaje']) ?></div>
    <?php endif; ?>

    <table class="table table-dark table-bordered table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>Fecha</th>
                <th>Usuario</th>
                <th>Total</th>
                <th>Detalle</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($ventas as $venta): ?>
                <tr>
                    <td><?= $venta['venta_id'] ?></td>
                    <td><?= $venta['fecha'] ?></td>
                    <td><?= $venta['usuario_nombre'] . " " . $venta['usuario_apellido'] ?></td>
                    <td>S/ <?= number_format($venta['total'], 2) ?></td>
                    <td><a href="index.php?vista=venta_detalle&id=<?php echo $venta['venta_id']; ?>">Ver</a></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
