<?php
require '../../res/php/titles.php';
require '../../res/php/app_topPos.php';

$idamb      = $_POST['idamb'];
$nomamb     = $_POST['amb'];
$user       = $_POST['user'];
$iduser     = $_POST['iduser'];
$logo       = $_POST['logo'];
$desdefe    = $_POST['desdeFe'];
$hastafe    = $_POST['hastaFe'];

$bases    = $pos->traeMovimientosBalanceCajaMes($desdefe, $hastafe, 0, $idamb);
$cajas    = $pos->traeMovimientosBalanceCajaMes($desdefe, $hastafe, 1, $idamb);
$carteras = $pos->traeRecaudosCarteraMes($desdefe, $hastafe, $idamb, 2);

$pagos    = $pos->getDetalleFormasdePagoBalanceCajaMes('A', $desdefe, $hastafe, $idamb);

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter'); 
$pdf->Image('../../img/' . $logo, 10, 10, 22);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 4, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 4, 'NIT: ' . NIT_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 4, 'BALANCE DIARIO DE CAJA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Desde  Fecha ' . $desdefe . ' Hasta Fecha ' . $hastafe, 0, 1, 'C');
$pdf->Ln(5);

$totbase  = 0;
$totcaja  = 0;
$totcart  = 0;
$efecart  = 0;
$totefec  = 0;
$totvent  = 0;
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 5, 'BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(90, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(50, 5, 'Cajero. ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Monto', 1, 0, 'C');
$pdf->Cell(20, 5, 'Fecha', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($bases) == 0) {
  $pdf->Cell(190, 5, 'SIN BASE DE CAJA', 1, 1, 'C');
} else {
  foreach ($bases as $caja) {
    $totbase = $totbase + $caja['monto'];
    $pdf->Cell(90, 4, utf8_decode($caja['concepto']), 0, 0, 'l');
    $pdf->Cell(50, 4, utf8_decode($caja['proveedor']), 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($caja['monto'], 2), 0, 0, 'R');
    $pdf->Cell(20, 4, $caja['fecha'], 0, 1, 'R');
  }
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(70, 5, 'Total Base Caja', 1, 0, 'L');
  $pdf->Cell(25, 5, number_format($totbase, 2), 1, 1, 'C');
}
$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 5, 'COMPRAS BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(70, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Documento ', 1, 0, 'C');
$pdf->Cell(50, 5, 'Proveedor. ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Valor', 1, 0, 'C');
$pdf->Cell(20, 5, 'Fecha', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

if (count($cajas) == 0) {
  $pdf->Cell(190, 5, 'SIN COMPRAS POR BASE DE CAJA', 1, 1, 'C');
} else {
  foreach ($cajas as $caja) {
    $totcaja = $totcaja + $caja['monto'];
    $pdf->Cell(70, 4, utf8_decode(substr($caja['concepto'], 0, 30)), 0, 0, 'L');
    $pdf->Cell(30, 4, $caja['documento'], 0, 0, 'L');
    $pdf->Cell(50, 4, utf8_decode($caja['proveedor']), 0, 0, 'L');
    $pdf->Cell(20, 4, number_format($caja['monto'], 2), 0, 0, 'R');
    $pdf->Cell(20, 4, $caja['fecha'], 0, 1, 'R');
  }
  $pdf->SetFont('Arial', 'B', 9);
  $pdf->Cell(70, 5, 'Total Compras Por Caja', 1, 0, 'L');
  $pdf->Cell(25, 5, number_format($totcaja, 2), 1, 1, 'C');
}

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(190, 5, 'RECAUDOS DE CARTERA  BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(70, 5, 'Proveedor. ', 1, 0, 'C');
$pdf->Cell(75, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Valor Pagado', 1, 0, 'C');
$pdf->Cell(20, 5, 'Fecha', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($carteras) == 0) {
  $pdf->Cell(190, 5, 'SIN RECAUDOS DE CARTERA POR BASE DE CAJA', 1, 1, 'C');
  $pdf->Ln(2);
} else {
  foreach ($carteras as $caja) {
    if ($caja['id_pago'] == 1) {
      $efecart = $efecart + $caja['monto'];
    }
    $totcart = $totcart + $caja['monto'];
    $pdf->Cell(70, 4, utf8_decode($pos->traeClienteCartera($caja['proveedor'])), 0, 0, 'L');
    $pdf->Cell(75, 4, utf8_decode(substr($caja['concepto'], 0, 42)), 0, 0, 'L');
    $pdf->Cell(25, 4, number_format($caja['monto'], 2), 0, 0, 'R');
    $pdf->Cell(20, 4, $caja['fecha'], 0, 1, 'R');
  }
  $pdf->SetFont('Arial', 'B', 10);
  $pdf->Cell(70, 5, 'Total Recuados de Cartera Por Caja', 1, 0, 'L');
  $pdf->Cell(25, 5, number_format($totcart, 2), 1, 1, 'C');
}

$pdf->Ln(5);
$pdf->Cell(130, 5, 'VENTAS DEL DIA BASE DE CAJA', 1, 1, 'C');
$pdf->Cell(30, 5, 'Usuario ', 1, 0, 'C');
$pdf->Cell(70, 5, 'Concepto ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Valor Facturado', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if (count($pagos) == 0) {
  $pdf->Cell(190, 5, 'SiN VENTAS DEL DIA', 0, 1, 'C');
} else {

  foreach ($pagos as $caja) {
    if ($caja['id_pago'] == 1) {
      $totefec = $totefec + $caja['total'];
    }
    $totvent = $totvent + $caja['total'];
    $pdf->Cell(30, 4, $caja['usuario'], 0, 0, 'L');
    $pdf->Cell(70, 4, utf8_decode($caja['descripcion']), 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($caja['total'], 2), 0, 1, 'R');
  }
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(70, 5, 'Total Ventas del Dia', 1, 0, 'L');
$pdf->Cell(30, 5, number_format($totvent, 2), 1, 1, 'R');

$pdf->Ln(5);
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(70, 5, strtoupper('Saldo Total Efectivo Caja '), 1, 0, 'L');
$pdf->Cell(30, 5, number_format($totbase - $totcaja + $efecart + $totefec, 2), 1, 1, 'R');

$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
