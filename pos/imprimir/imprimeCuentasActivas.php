<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.LOGO, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 5, $_SESSION['NOMBRE_AMBIENTE'], 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'COMANDAS ACTIVAS ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', '', 9);

$comandas = $pos->getComandasActivas($idamb, 'A');

$monto = 0;
$impto = 0;
$total = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(60, 6, 'Cliente', 1, 0, 'C');
$pdf->Cell(25, 6, 'Comanda', 1, 0, 'C');
$pdf->Cell(20, 6, 'Mesa ', 1, 0, 'C');
$pdf->Cell(30, 6, 'Usuario', 1, 0, 'C');
$pdf->Cell(20, 6, 'Hora', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($comandas) == 0) {
    $pdf->Cell(155, 5, 'SIN COMANDAS ACTIVAS', 1, 1, 'C');
} else {
    foreach ($comandas as $comanda) {
        $pdf->Cell(60, 5, $comanda['cliente'], 0, 0, 'L');
        $pdf->Cell(25, 5, $comanda['comanda'], 0, 0, 'C');
        $pdf->Cell(20, 5, $comanda['mesa'], 0, 0, 'C');
        $pdf->Cell(30, 5, $comanda['usuario'], 0, 0, 'R');
        $pdf->Cell(20, 5, substr($comanda['fecha_comanda'], 11, 5), 0, 1, 'R');
    }
}
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));
echo $base64String;
