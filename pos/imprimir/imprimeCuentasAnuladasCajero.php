<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.LOGO, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 6, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(190, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 5, 'COMANDAS ANULADAS ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(95, 5, 'Usuario '.$user, 0, 0, 'R');
$pdf->Cell(95, 5, 'Fecha : '.$fecha, 0, 1, 'L');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 5, 'Cliente.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Comanda.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Mesa ', 1, 0, 'C');
$pdf->Cell(20, 5, 'PAX. ', 1, 0, 'C');
$pdf->Cell(15, 5, 'Hora', 1, 0, 'C');
$pdf->Cell(70, 5, 'Motivo Anulacion', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$comandas = $pos->getComandasAnuladasCajero($idamb, 'X', $iduser);

$monto = 0;
$impto = 0;
$total = 0;
if (count($comandas) == 0) {
    $pdf->Cell(195, 5, 'SIN COMANDAS ANULADAS', 1, 1, 'C');
} else {
    foreach ($comandas as $comanda) {
        $pdf->Cell(50, 5, $comanda['cliente'], 0, 0, 'L');
        $pdf->Cell(20, 5, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['pax'], 0, 0, 'C');
        $pdf->Cell(15, 5, substr($comanda['fecha_comanda_anulada'], 11, 5), 0, 0, 'R');
        $pdf->Cell(70, 5, substr($comanda['motivo_anulada'], 0, 43), 0, 1, 'L');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
