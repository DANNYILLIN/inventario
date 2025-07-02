<?php
require_once "../fpdf186/fpdf.php";
require_once "main.php";

class PDF extends FPDF {
    function Header() {
        $this->SetFont('Arial', 'B', 14);
        $this->Cell(0, 10, 'Reporte de Productos', 0, 1, 'C');
        $this->Ln(5);
    }

    function Footer() {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo(), 0, 0, 'C');
    }
}

// Consulta productos
$db = conexion();
$stmt = $db->query("SELECT producto_nombre, producto_precio, producto_stock FROM producto ORDER BY producto_nombre ASC");
$productos = $stmt->fetchAll();

$pdf = new PDF();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);

// Encabezado tabla
$pdf->SetFillColor(200, 200, 200);
$pdf->Cell(80, 10, 'Producto', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Precio (S/)', 1, 0, 'C', true);
$pdf->Cell(30, 10, 'Stock', 1, 0, 'C', true);
$pdf->Cell(40, 10, 'Estado', 1, 1, 'C', true);

// Datos
foreach ($productos as $prod) {
    $estado = ($prod['producto_stock'] <= 2) ? 'Bajo' : 'Normal';
    $pdf->Cell(80, 10, $prod['producto_nombre'], 1);
    $pdf->Cell(30, 10, number_format($prod['producto_precio'], 2), 1, 0, 'R');
    $pdf->Cell(30, 10, $prod['producto_stock'], 1, 0, 'C');
    $pdf->Cell(40, 10, $estado, 1, 1, 'C');
}

$pdf->Output('I', 'reporte_productos.pdf');
