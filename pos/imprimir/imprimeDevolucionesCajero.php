<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 13);

$pdf->Cell(195, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(195, 5, 'DEVOLUCION DE PRODUCTOS ', 0, 1, 'C');
$pdf->Cell(195, 5, 'USUARIO '.$user.' FECHA '.$fecha, 0, 1, 'C');
$devoluciones = $pos->getDevolucionUsuario($idamb, $user);

$monto = 0;
$impto = 0;
$total = 0;
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Mesa ', 1, 0, 'C');
$pdf->Cell(70, 5, 'Producto. ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Cantidad', 1, 0, 'C');
$pdf->Cell(65, 5, 'Motivo Devolucion', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

if (count($devoluciones) == 0) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(195, 5, 'SIN DEVOLUCION DE PRODUCTOS ', 1, 1, 'C');
} else {
    foreach ($devoluciones as $comanda) {
        $pdf->Cell(20, 4, $comanda['comanda'], 1, 0, 'C');
        $pdf->Cell(20, 4, $comanda['mesa'], 1, 0, 'C');
        $pdf->Cell(70, 4, utf8_decode($comanda['nom']), 1, 0, 'L');
        $pdf->Cell(20, 4, $comanda['cant'], 1, 0, 'C');
        $pdf->Cell(65, 4, utf8_decode($comanda['motivo_devo']), 1, 1, 'L');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
