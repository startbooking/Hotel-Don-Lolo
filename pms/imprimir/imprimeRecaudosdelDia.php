<?php

$file = $_POST['file'];
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];

require_once '../../res/php/app_topHotel.php';
require_once '../imprimir/plantillaFpdfFinancL.php';

$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 10); 
$pdf->Cell(195, 4, 'RECAUDOS DEL DIA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(195, 4, 'Fecha : '.FECHA_PMS, 0, 1, 'C');

$pdf->SetFont('Arial', '', 8);
$recaudos = $hotel->traeRecaudosCartera();
$pag = 0;
$monto = 0;

$pdf->Cell(20, 5, 'Numero', 1, 0, 'C');
$pdf->Cell(20, 5, 'Fecha', 1, 0, 'C');
$pdf->Cell(100, 5, 'Empresa.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Valor', 1, 0, 'C');
$pdf->Cell(20, 5, 'Usuario ', 1, 1, 'C');

foreach ($recaudos as $codigo) {
    $pdf->Cell(20, 5, $codigo['numeroRecaudo'], 0, 0, 'L');
    $pdf->Cell(20, 5, $codigo['fechaRecaudo'], 0, 0, 'L');
    $pdf->Cell(100, 5, $codigo['empresa'], 0, 0, 'L');
    $pdf->Cell(20, 5, number_format($codigo['totalRecaudo'],2), 0, 0, 'R');
    $pdf->Cell(20, 5, $codigo['usuario'], 0, 1, 'L');
    $pag = $pag + $codigo['totalRecaudo'];
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(140, 5, 'Total Recaudos Del Dia', 1, 0, 'L');
// $pdf->SetFont('Arial', '', 8);
$pdf->Cell(20, 5, number_format($pag, 2), 1, 1, 'R');
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
