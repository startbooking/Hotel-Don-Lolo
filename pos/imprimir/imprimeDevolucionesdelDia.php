<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);

$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 6, $nomamb, 0, 1, 'C');
$devoluciones = $pos->getDevolucionesDia($idamb);

$monto = 0;
$impto = 0;
$total = 0;
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 7, 'DEVOLUCION DE PRODUCTOS ', 0, 1, 'C');

if (count($devoluciones) == 0) {
    $pdf->Cell(190, 5, 'SIN DEVOLUCION DE PRODUCTOS  ', 0, 1, 'C');
} else {
    $pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
    $pdf->Cell(20, 5, 'Mesa ', 1, 0, 'C');
    $pdf->Cell(60, 5, 'Producto. ', 1, 0, 'C');
    $pdf->Cell(10, 5, 'Cant.', 1, 0, 'C');
    $pdf->Cell(65, 5, 'Motivo Devolucion', 1, 0, 'C');
    $pdf->Cell(25, 5, 'Usuario', 1, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    foreach ($devoluciones as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 1, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 1, 0, 'C');
        $pdf->Cell(60, 5, utf8_decode($comanda['nom']), 1, 0, 'L');
        $pdf->Cell(10, 5, $comanda['cant'], 1, 0, 'C');
        $pdf->Cell(65, 5, utf8_decode($comanda['motivo_devo']), 1, 0, 'L');
        $pdf->Cell(25, 5, $comanda['usuario_devo'], 1, 1, 'L');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
