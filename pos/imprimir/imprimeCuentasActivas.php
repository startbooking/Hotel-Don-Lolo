<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 5, $nomamb, 0, 1, 'C');

$pdf->SetFont('Arial', '', 11);
$pdf->Cell(195, 5, 'COMANDAS ACTIVAS ', 0, 1, 'C');
$pdf->Cell(195, 5, 'Fecha: '.$fecha, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Mesa ', 1, 0, 'C');
$pdf->Cell(20, 5, 'PAX. ', 1, 0, 'C');
$pdf->Cell(40, 5, 'Usuario', 1, 0, 'C');
$pdf->Cell(25, 5, 'Hora Comanda', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$comandas = $pos->getComandasActivas($idamb, 'A');

$monto = 0;
$impto = 0;
$total = 0;
if (count($comandas) == 0) {
    $pdf->Cell(110, 5, 'SIN COMANDAS ACTIVAS', 1, 1, 'C');
    $pdf->Ln(2);
} else {
    foreach ($comandas as $comanda) {
        $pdf->Cell(20, 5, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['pax'], 0, 0, 'C');
        $pdf->Cell(40, 5, $comanda['usuario'], 0, 0, 'R');
        $pdf->Cell(25, 5, date('H:m:i', strtotime($comanda['fecha_comanda'])), 0, 1, 'R');
    }
}
$pdf->Ln(3);
$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
