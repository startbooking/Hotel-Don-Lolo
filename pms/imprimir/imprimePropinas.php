<?php

$postBody = json_decode(file_get_contents('php://input'), true);
extract($postBody);

require_once '../../res/php/app_topHotel.php';
require_once '../imprimir/plantillaFpdfFinanc.php';

$pdf = new PDF();
$pdf->AddPage('L', 'letter');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(260, 5, 'PROPINAS POR USUARIO', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(260, 5, 'Desde Fecha : ' . $desdeFe . ' Hasta Fecha ' . $hastaFe, 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 10);
$usuarios = $hotel->traeUsuariosPosVentas($desdeFe, $hastaFe, 25);

$mon   = 0;
$imp   = 0;
$tot   = 0;
$monto = 0;
$impto = 0;
$total = 0;

foreach ($usuarios as $usuario) {
  $pdf->Ln(2);
  $pdf->Cell(20, 5, 'Usuario ', 0, 0, 'L');
  $pdf->Cell(50, 5, ($usuario['apellidos'] . ' ' . $usuario['nombres']), 0, 1, 'L');

  $cargos = $hotel->getCargosPropinas($desdeFe, $hastaFe, $usuario['usuario']);

  if (count($cargos) != 0) {
    $pdf->Cell(50, 5, 'Descripcion.', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Hab.', 0, 0, 'R');
    $pdf->Cell(70, 5, 'Huesped', 0, 0, 'C');
    $pdf->Cell(35, 5, 'Comanda. ', 0, 0, 'C');
    $pdf->Cell(35, 5, 'Monto', 0, 0, 'C');
    $pdf->Cell(20, 5, 'Fecha', 0, 0, 'C');
    $pdf->Cell(15, 5, 'Hora', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    $monto  = 0;
    $impto  = 0;
    $total  = 0;
    foreach ($cargos as $cargo) {
      $pdf->Cell(50, 6, ($cargo['descripcion_cargo']), 0, 0, '');
      $pdf->Cell(10, 6, $cargo['habitacion_cargo'], 0, 0, 'R');
      $pdf->Cell(70, 6, substr(($cargo['nombre_completo']), 0, 35), 0, 0, 'L');
      $pdf->Cell(35, 6, $cargo['numero_factura_cargo'], 0, 0, 'R');
      $pdf->Cell(35, 6, number_format($cargo['monto_cargo'], 2), 0, 0, 'R');
      $pdf->Cell(20, 6, $cargo['fecha_cargo'], 0, 0, 'R');
      $pdf->Cell(15, 6, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
      $monto  = $monto + $cargo['monto_cargo'];
    }
    $mon  = $mon + $monto;

    $pdf->Ln(2);
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(40, 6, 'Total Propina Cajero', 0, 0, 'L');
    $pdf->Cell(110, 6, ($usuario['apellidos'] . ' ' . $usuario['nombres']), 0, 0, 'L');
    $pdf->Cell(25, 6, number_format($monto, 2), 0, 1, 'R');
    $pdf->Ln(3);
  }
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(150, 6, 'Total Propinas Del Periodo', 0, 0, 'L');
$pdf->Cell(25, 6, number_format($mon, 2), 0, 1, 'R');
$pdf->Ln(3);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
