<?php
require_once "../fpdf186/fpdf.php";
require_once "main.php";

class PDF extends FPDF {
    function Header() {
        global $desde, $hasta;

        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Ventas', 0, 1, 'C');
        $this->SetFont('Arial', '', 11);
        $this->Cell(0, 10, utf8_decode("Desde: $desde - Hasta: $hasta"), 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Obtener fechas por GET
$desde = $_GET['desde'] ?? null;
$hasta = $_GET['hasta'] ?? null;

if (!$desde || !$hasta) {
    die("Debes seleccionar el rango de fechas.");
}

// Asegurar que incluya todo el día final
$desde_filtro = $desde . " 00:00:00";
$hasta_filtro = $hasta . " 23:59:59";

// Obtener datos desde la BD
$db = conexion();
$stmt = $db->prepare("SELECT v.venta_id, v.fecha, v.total, u.usuario_nombre, u.usuario_apellido 
                      FROM venta v
                      LEFT JOIN usuario u ON v.usuario_id = u.usuario_id
                      WHERE v.fecha BETWEEN ? AND ?
                      ORDER BY v.fecha ASC");
$stmt->execute([$desde_filtro, $hasta_filtro]);
$ventas = $stmt->fetchAll();

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Encabezado de tabla
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Usuario', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Total', 1, 1, 'C', true);

// Datos
foreach ($ventas as $venta) {
    $pdf->Cell(20, 10, $venta['venta_id'], 1);
    $pdf->Cell(40, 10, $venta['fecha'], 1);
    $pdf->Cell(60, 10, $venta['usuario_nombre'] . " " . $venta['usuario_apellido'], 1);
    $pdf->Cell(30, 10, "S/ " . number_format($venta['total'], 2), 1, 1);
}

// Mostrar PDF
$pdf->Output('I', 'reporte_ventas.pdf');
