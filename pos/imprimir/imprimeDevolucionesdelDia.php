<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.LOGO, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 6, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(190, 5, 'DEVOLUCION DE PRODUCTOS ', 0, 1, 'C');
$pdf->Cell(190, 4, 'Fecha : '.$fecha, 0, 1, 'C');

$pdf->Ln(2);

$devoluciones = $pos->getDevolucionesDia($idamb, $fecha);

$monto = 0;
$impto = 0;
$total = 0;
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 6, 'Comanda.', 1, 0, 'C');
$pdf->Cell(20, 6, 'Mesa ', 1, 0, 'C');
$pdf->Cell(60, 6, 'Producto. ', 1, 0, 'C');
$pdf->Cell(10, 6, 'Cant.', 1, 0, 'C');
$pdf->Cell(65, 6, 'Motivo Devolucion', 1, 0, 'C');
$pdf->Cell(25, 6, 'Usuario', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

if (count($devoluciones) == 0) {
    $pdf->Cell(200, 5, 'SIN DEVOLUCION DE PRODUCTOS  ', 1, 1, 'C');
} else {
    foreach ($devoluciones as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(60, 5, utf8_decode(substr($comanda['nom'], 0, 28)), 0, 0, 'L');
        $pdf->Cell(10, 5, $comanda['cantidad_devo'], 0, 0, 'C');
        $pdf->Cell(65, 5, $comanda['motivo_devo'], 0, 0, 'L');
        $pdf->Cell(25, 5, $comanda['usuario_devo'], 0, 1, 'L');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));
echo $base64String;
