<?php
require_once "./php/main.php";

// Obtener productos
$consulta = conexion()->query("SELECT * FROM producto ORDER BY producto_nombre ASC");
$productos = $consulta->fetchAll();
?>

<section class="section">
  <div class="container">
    <h1 class="title">Nueva Venta</h1>

    <form id="form-agregar-producto" class="box">
      <div class="columns">
        <div class="column is-half">
          <div class="field">
            <label class="label">Producto</label>
            <div class="control">
              <div class="select is-fullwidth">
                <select id="producto_id" name="producto_id" required>
                  <option value="" disabled selected>Seleccione un producto</option>
                  <?php foreach ($productos as $producto): ?>
                    <option value="<?php echo $producto['producto_id']; ?>"
                      data-precio="<?php echo $producto['producto_precio']; ?>"
                      data-stock="<?php echo $producto['producto_stock']; ?>">
                      <?php echo $producto['producto_nombre']; ?> - S/.<?php echo $producto['producto_precio']; ?> (Stock: <?php echo $producto['producto_stock']; ?>)
                    </option>
                  <?php endforeach; ?>
                </select>
              </div>
            </div>
          </div>

          <div class="field">
            <label class="label">Cantidad</label>
            <div class="control">
              <input class="input" type="number" min="1" id="cantidad" required>
            </div>
          </div>

          <div class="control">
            <button type="button" class="button is-link" onclick="agregarProducto()">Agregar al carrito</button>
          </div>
        </div>
      </div>
    </form>

    <h2 class="subtitle mt-5">Productos en la venta</h2>
    <form action="./php/venta_guardar.php" method="POST" onsubmit="return prepararVenta()">
      <div class="table-container">
        <table class="table is-fullwidth is-bordered" id="tabla-carrito">
          <thead>
            <tr>
              <th>Producto</th>
              <th>Precio</th>
              <th>Cantidad</th>
              <th>Subtotal</th>
              <th>Acciones</th>
            </tr>
          </thead>
          <tbody></tbody>
        </table>
      </div>

      <!-- Totales -->
      <div class="box">
        <p><strong>Subtotal:</strong> S/ <span id="subtotal">0.00</span></p>
        <p><strong>IGV (18%):</strong> S/ <span id="igv">0.00</span></p>
        <p><strong>Total:</strong> S/ <span id="total">0.00</span></p>
      </div>

      <input type="hidden" name="venta_detalle" id="venta_detalle">
      <div class="mt-4">
        <button type="submit" class="button is-success">Registrar venta</button>
      </div>
    </form>
  </div>
</section>

<script>
let carrito = [];

function agregarProducto() {
  const select = document.getElementById('producto_id');
  const cantidad = parseInt(document.getElementById('cantidad').value);

  if (!select.value || cantidad <= 0) return;

  const option = select.options[select.selectedIndex];
  const nombre = option.text;
  const precio = parseFloat(option.dataset.precio);
  const stock = parseInt(option.dataset.stock);
  const id = select.value;

  if (cantidad > stock) {
    alert("Cantidad supera el stock disponible.");
    return;
  }

  carrito.push({ id, nombre, precio, cantidad });
  actualizarTabla();
  actualizarTotales();
}

function actualizarTabla() {
  const tbody = document.querySelector("#tabla-carrito tbody");
  tbody.innerHTML = "";

  carrito.forEach((item, index) => {
    const fila = `<tr>
      <td>${item.nombre}</td>
      <td>S/.${item.precio.toFixed(2)}</td>
      <td>${item.cantidad}</td>
      <td>S/.${(item.precio * item.cantidad).toFixed(2)}</td>
      <td><button type="button" class="button is-small is-danger" onclick="eliminarProducto(${index})">Eliminar</button></td>
    </tr>`;
    tbody.innerHTML += fila;
  });
}

function actualizarTotales() {
  let totalBruto = 0;

  carrito.forEach(item => {
    totalBruto += item.precio * item.cantidad;
  });

  const subtotal = totalBruto / 1.18;
  const igv = totalBruto - subtotal;
  const total = totalBruto;

  document.getElementById("subtotal").textContent = subtotal.toFixed(2);
  document.getElementById("igv").textContent = igv.toFixed(2);
  document.getElementById("total").textContent = total.toFixed(2);
}

function eliminarProducto(index) {
  carrito.splice(index, 1);
  actualizarTabla();
  actualizarTotales();
}

function prepararVenta() {
  if (carrito.length === 0) {
    alert("Agregue al menos un producto a la venta.");
    return false;
  }
  document.getElementById('venta_detalle').value = JSON.stringify(carrito);
  return true;
}
</script>

