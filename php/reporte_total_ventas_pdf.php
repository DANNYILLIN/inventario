<?php
require_once "../fpdf186/fpdf.php";
require_once "main.php"; // tu archivo con conexión DB

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Ventas', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Tabla de encabezado
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(20, 10, 'ID', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Fecha', 1, 0, 'C', true);
$pdf->Cell(60, 10, 'Usuario', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Total', 1, 1, 'C', true);

// Obtener datos
$db = conexion();
$sql = "SELECT v.venta_id, v.fecha, v.total, u.usuario_nombre, u.usuario_apellido 
        FROM venta v
        LEFT JOIN usuario u ON v.usuario_id = u.usuario_id
        ORDER BY v.venta_id DESC";
$ventas = $db->query($sql)->fetchAll();

foreach ($ventas as $venta) {
    $pdf->Cell(20, 10, $venta['venta_id'], 1);
    $pdf->Cell(40, 10, $venta['fecha'], 1);
    $pdf->Cell(60, 10, $venta['usuario_nombre'] . " " . $venta['usuario_apellido'], 1);
    $pdf->Cell(30, 10, "S/ " . number_format($venta['total'], 2), 1, 1);
}

$pdf->Output('I', 'reporte_ventas.pdf');
