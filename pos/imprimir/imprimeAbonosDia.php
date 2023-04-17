<?php

require_once '../../res/fpdf/fpdf.php';
$detalles = $pos->traeAbonosTotal($idamb);

$pdf = new FPDF();
$pdf->AddPage('L', 'letter');
$pdf->Image('../../img/'.LOGO, 10, 10, 22);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(260, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(260, 5, 'ABONOS DEL DIA '.$fecha, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(260, 5, ' Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 6, 'Abono. ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Comanda. ', 1, 0, 'C');
$pdf->Cell(40, 6, 'Forma de Pago ', 1, 0, 'C');
$pdf->Cell(25, 6, 'Total Abono ', 1, 0, 'C');
$pdf->Cell(30, 6, 'Usuario ', 1, 0, 'C');
$pdf->Cell(70, 6, 'Detalle Abono ', 1, 0, 'C');
$pdf->Cell(20, 6, 'Hora ', 1, 1, 'C');

$pdf->SetFont('Arial', '', 9);
$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$desc = 0;
if (count($detalles) == 0) {
    $pdf->Cell(225, 5, 'SIN ABONOS EN EL DIA', 1, 1, 'C');
} else {
    foreach ($detalles as $detalle) {
        $fact = $fact + 1;
        $neto = $neto + $detalle['valor'];
        $pdf->Cell(20, 6, $detalle['abono_numero'], 1, 0, 'R');
        $pdf->Cell(20, 6, $detalle['comanda'], 1, 0, 'R');
        $pdf->Cell(40, 6, substr($detalle['descripcion'], 0, 19), 1, 0, 'L');
        $pdf->Cell(25, 6, number_format($detalle['valor'], 2), 1, 0, 'R');
        $pdf->Cell(30, 6, $detalle['usuario'], 1, 0, 'L');
        $pdf->Cell(70, 6, substr($detalle['comentarios'], 0, 35), 1, 0, 'L');
        $pdf->Cell(20, 6, substr($detalle['created_at'], 11, 8), 1, 1, 'R');
    }
    $pdf->Cell(80, 6, 'Total', 1, 0, 'C');
    $pdf->Cell(25, 6, number_format($neto, 2), 1, 1, 'R');
}
$pdf->Ln(5);

/*
  $ofile = '../imprimir/informes/'.$file.'.pdf';
  $pdf->Output($ofile,'F');
*/
$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
