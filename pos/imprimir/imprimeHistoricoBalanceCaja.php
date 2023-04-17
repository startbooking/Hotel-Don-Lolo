<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/' . LOGO, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 4, $nomamb, 0, 1, 'C');

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 4, 'NIT: ' . NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Ln(1);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 4, 'BALANCE DIARIO DE CAJA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 4, 'Fecha ' . $fecha, 0, 1, 'C');
$pdf->Ln(2);

$bases    = $pos->traeMovimientosBalanceCaja($fecha, 0);
$cajas    = $pos->traeMovimientosBalanceCaja($fecha, 1);
$carteras = $pos->traeMovimientosBalanceCaja($fecha, 2);

$pagos    = $pos->getDetalleFormasdePagoBalanceCaja('A', $idamb);

$totbase  = 0;
$totcaja  = 0;
$totcart  = 0;
$totefec  = 0;
$totvent  = 0;
if (count($bases) == 0) {
  $pdf->Ln(2);
  $pdf->Cell(190, 5, 'SIN BASE DE CAJA', 0, 0, 'C');
  $pdf->Ln(2);
} else {
  $pdf->Ln(2);
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(190, 5, 'BASE DE CAJA', 1, 1, 'C');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(110, 6, 'Concepto ', 1, 0, 'C');
  $pdf->Cell(50, 6, 'Cajero. ', 1, 0, 'C');
  $pdf->Cell(30, 6, 'Monto', 1, 1, 'C');

  foreach ($bases as $caja) {
    $totbase = $totbase + $caja['monto'];
    $pdf->Cell(110, 5, $caja['concepto'], 0, 0, 'l');
    $pdf->Cell(50, 5, $caja['proveedor'], 0, 0, 'L');
    $pdf->Cell(30, 5, number_format($caja['monto'], 2), 0, 1, 'R');
  }
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 6, 'Total Base Caja', 0, 0, 'L');
$pdf->Cell(25, 6, number_format($totbase, 2), 0, 1, 'C');
$pdf->Ln(5);
$pdf->SetFont('Arial', '', 10);

if (count($cajas) == 0) {
  $pdf->Cell(190, 5, 'SIN COMPRAS POR BASE DE CAJA', 0, 0, 'C');
  $pdf->Ln(2);
} else {
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(190, 5, 'COMPRAS BASE DE CAJA', 1, 1, 'C');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(70, 6, 'Concepto ', 1, 0, 'C');
  $pdf->Cell(30, 6, 'Documento ', 1, 0, 'C');
  $pdf->Cell(50, 6, 'Proveedor. ', 1, 0, 'C');
  $pdf->Cell(40, 6, 'Valor', 1, 1, 'C');
  foreach ($cajas as $caja) {
    $totcaja = $totcaja + $caja['monto'];
    $pdf->Cell(70, 5, substr($caja['concepto'], 0, 30), 0, 0, 'L');
    $pdf->Cell(30, 5, $caja['documento'], 0, 0, 'L');
    $pdf->Cell(50, 5, $caja['proveedor'], 0, 0, 'L');
    $pdf->Cell(20, 5, '', 0, 0, 'R');
    $pdf->Cell(20, 5, number_format($caja['monto'], 2), 0, 1, 'R');
  }
}

$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 6, 'Total Compras Por Caja', 0, 0, 'L');
$pdf->Cell(25, 6, number_format($totcaja, 2), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);

$pdf->Ln(5);
if (count($carteras) == 0) {
  $pdf->Cell(190, 5, 'SIN RECAUDOS DE CARTERA POR BASE DE CAJA', 1, 1, 'C');
  $pdf->Ln(2);
} else {
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(190, 5, 'RECAUDOS DE CARTERA  BASE DE CAJA', 1, 1, 'C');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(80, 6, 'Concepto ', 1, 0, 'C');
  $pdf->Cell(80, 6, 'Proveedor. ', 1, 0, 'C');
  $pdf->Cell(30, 6, 'Valor Pagado', 1, 1, 'C');

  foreach ($carteras as $caja) {
    $totcart = $totcart + $caja['monto'];

    $pdf->Cell(80, 5, utf8_decode($pos->traeClienteCartera($caja['proveedor'])), 0, 0, 'L');
    $pdf->Cell(80, 5, substr($caja['concepto'], 0, 42), 0, 0, 'L');
    $pdf->Cell(30, 5, number_format($caja['monto'], 2), 0, 1, 'R');
  }
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 6, 'Total Recuados de Cartera Por Caja', 0, 0, 'L');
$pdf->Cell(25, 6, number_format($totcart, 2), 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);

$pdf->Ln(5);
if (count($pagos) == 0) {
  $pdf->Cell(190, 5, 'SiN VENTAS DEL DIA', 0, 1, 'C');
  $pdf->Ln(2);
} else {
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(190, 5, 'VENTAS DEL DIA BASE DE CAJA', 1, 1, 'C');
  $pdf->SetFont('Arial', '', 10);
  $pdf->Cell(70, 6, 'Concepto ', 1, 0, 'C');
  $pdf->Cell(30, 6, 'Valor Facturado', 1, 0, 'C');
  $pdf->Cell(20, 6, '', 0, 1, 'C');

  foreach ($pagos as $caja) {
    if ($caja['id_pago'] == 1) {
      $totefec = $totefec + $caja['neto'];
    }
    $totvent = $totvent + $caja['neto'];
    $pdf->Cell(70, 4, $caja['descripcion'], 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($caja['neto'], 2), 0, 1, 'R');
  }
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 6, 'Total Ventas del Dia', 0, 0, 'L');
$pdf->Cell(30, 6, number_format($totvent, 2), 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 6, 'Saldo Total Efectivo Caja ', 0, 0, 'L');
$pdf->Cell(30, 6, number_format($totbase - $totcaja + $totcart + $totefec, 2), 0, 1, 'R');
$pdf->SetFont('Arial', '', 10);

$pdf->Ln(3);

$file = '../imprimir/informes/' . $file . '.pdf';

$pdf->Output($file, 'F');
