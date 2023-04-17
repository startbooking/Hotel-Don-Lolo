<?php

$productos = $pos->getDevolucionProductos($idamb, $fecha);

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.LOGO, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 5, $_SESSION['NOMBRE_AMBIENTE'], 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'DEVOLUCION PRODUCTOS ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);

$monto = 0;
$impto = 0;
$total = 0;
$valprod = 0;
$canti = 0;
$pdf->Cell(20, 6, 'Comanda.', 1, 0, 'C');
$pdf->Cell(60, 6, 'Producto.', 1, 0, 'C');
$pdf->Cell(20, 6, 'Cantidad ', 1, 0, 'C');
$pdf->Cell(70, 6, 'Motivo Devolucion ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Usuario ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($productos) == 0) {
    $pdf->Cell(195, 5, 'SIN PRODUCTOS DEVUELTOS EN EL DIA', 1, 1, 'C');
} else {
    foreach ($productos as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 0, 0, 'R');
        $pdf->Cell(60, 5, utf8_decode($comanda['nom']), 0, 0, 'L');
        $pdf->Cell(20, 5, $comanda['cantidad_devo'], 0, 0, 'C');
        $pdf->Cell(70, 5, $comanda['motivo_devo'], 0, 0, 'L');
        $pdf->Cell(25, 5, $comanda['usuario_devo'], 0, 1, 'L');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));
echo $base64String;
