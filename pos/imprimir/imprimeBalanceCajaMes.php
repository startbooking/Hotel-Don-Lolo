<?php
require_once '../../res/php/app_topPos.php';
require_once '../../res/fpdf/fpdf.php';
extract($_POST);

$pagos    = $pos->getDetalleFormasdePagoBalanceCajaMes('A', $desdeFe, $hastaFe, $id_ambiente);

$pdf = new FPDF(); 
$pdf->AddPage('P', 'letter'); 
$pdf->Image('../../img/' . $logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 4, NAME_EMPRESA, 0, 1, 'C');
$pdf->Cell(195, 4, $nombre, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 4, 'BALANCE DIARIO DE CAJA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Desde  Fecha ' . $desdeFe . ' Hasta Fecha ' . $hastaFe, 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 9);

$impt = 0;
$serv = 0;
$neto = 0;
$totl = 0;
$prop = 0;

$pdf->Cell(195, 5, 'VENTAS ACUMULADAS', 1, 1, 'C');
$pdf->Cell(20, 5, 'Usuario ', 1, 0, 'C');
$pdf->Cell(40, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Valor Neto', 1, 0, 'C');
$pdf->Cell(25, 5, 'Impuesto', 1, 0, 'C');
$pdf->Cell(25, 5, 'Room Service', 1, 0, 'C');
$pdf->Cell(25, 5, 'Propina', 1, 0, 'C');
$pdf->Cell(30, 5, 'Total', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($pagos) == 0) {
  $pdf->Cell(195, 5, 'SiN VENTAS ACUMULADAS', 0, 1, 'C');
} else {

  foreach ($pagos as $caja) {
    $neto += $caja['total'];
    $impt += $caja['impto'];
    $serv += $caja['servicio'];
    $prop += $caja['propina'];
    $totl += $caja['pagado']-$caja['cambio'];
    $pdf->Cell(20, 4, $caja['usuario'], 0, 0, 'L');
    $pdf->Cell(40, 4, ($caja['descripcion']), 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($caja['total'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($caja['impto'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($caja['servicio'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($caja['propina'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($caja['pagado']-$caja['cambio'], 2), 0, 1, 'R');
  }
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(60, 5, 'Total Ventas del Dia', 1, 0, 'L');
$pdf->Cell(30, 5, number_format($neto, 2), 1, 0, 'R');
$pdf->Cell(25, 5, number_format($impt, 2), 1, 0, 'R');
$pdf->Cell(25, 5, number_format($serv, 2), 1, 0, 'R');
$pdf->Cell(25, 5, number_format($prop, 2), 1, 0, 'R');
$pdf->Cell(30, 5, number_format($totl, 2), 1, 1, 'R');

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 5, strtoupper('Saldo Total Efectivo Caja '), 1, 0, 'L');

$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
