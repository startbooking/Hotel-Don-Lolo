<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('L', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(260, 6, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
// $pdf->Cell(260, 5, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(260, 6, 'VENTAS A CREDITO', 0, 1, 'C');
$pdf->Ln(5);

$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(180, 8, 'DETALLE VENTAS CREDITO DEL DIA ', 1, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(25, 6, 'Factura ', 1, 0, 'C');
$pdf->Cell(120, 6, 'Cliente', 1, 0, 'C');
$pdf->Cell(35, 6, 'Total Fact ', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$fact = 0;
$neto = 0;
$impt = 0;
$prop = 0;
$tota = 0;
$canti = 0;
foreach ($creditos as $detalle) {
    $fact = $fact + 1;
    $tota = $tota + $detalle['valor_total'];

    $pdf->Cell(25, 4, $detalle['factura'], 0, 0, 'R');
    $pdf->Cell(120, 4, utf8_decode($detalle['apellido1'].' '.$detalle['apellido2'].' '.$detalle['nombre1'].' '.$detalle['nombre2']), 0, 0, 'L');
    $pdf->Cell(35, 4, number_format($detalle['valor_total'], 2), 0, 1, 'R');
}
$pdf->Cell(145, 6, 'Total Ventas Credito', 1, 0, 'C');
$pdf->Cell(35, 6, number_format($tota, 2), 1, 1, 'R');

$pdf->Ln(5);

$file = '../imprimir/auditorias/VentasCreditoDia_'.$pref.'_'.$fecha.'.pdf';

$pdf->Output($file, 'F');
