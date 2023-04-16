<?php

require '../../../res/shared/plantillaInvVer.php';

$numeroSal   = $numeroMov;
$bodega      = $almacen;

$movimientos = $inven->getMovimientos(2, $numeroSal, $bodega);

$pdf = new PDF();
$pdf->AddPage('P', 'letter');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 7, 'SALIDA DE INVENTARIOS', 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 6, 'CENTRO DE COSTO', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80, 6, $inven->buscaCentroCosto($movimientos[0]['id_proveedor']), 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(50, 6, 'TIPO DE MOVIMIENTO', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(70, 6, $inven->getBuscaMovimiento($movimientos[0]['tipo_movi']), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 6, 'SALIDA NRO', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 6, $numeroSal, 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(40, 6, 'BODEGA', 0, 0, 'l');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(50, 6, $inven->buscaAlmacen($movimientos[0]['id_bodega']), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 6, 'Fecha :', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 6, $movimientos[0]['fecha_movimiento'], 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 6, 'Usuario :', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 6, $movimientos[0]['usuario'], 0, 1, 'L');

$pdf->Ln(4);
$pdf->Cell(70, 6, 'PRODUCTO', 1, 0, 'C');
$pdf->Cell(20, 6, 'CANT', 1, 0, 'C');
$pdf->Cell(45, 6, 'UNIDAD', 1, 0, 'C');
$pdf->Cell(30, 6, 'VALOR UNI.', 1, 0, 'C');
$pdf->Cell(30, 6, 'TOTAL', 1, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$totalsum  = 0;
foreach ($movimientos as $movimiento) {
  $totalsum = $totalsum + $movimiento['valor_total'];
  $pdf->Cell(70, 6, utf8_decode($movimiento['nombre_producto']), 1, 0, 'L');
  $pdf->Cell(20, 6, number_format($movimiento['cantidad'], 2), 1, 0, 'R');
  $pdf->Cell(45, 6, $inven->getUnidadAlmacena($movimiento['unidad_alm']), 1, 0, 'L');
  $pdf->Cell(30, 6, number_format($movimiento['valor_unitario'], 2), 1, 0, 'R');
  $pdf->Cell(30, 6, number_format($movimiento['valor_total'], 2), 1, 1, 'R');
}
$pdf->Cell(90, 6, '', 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(75, 6, 'VALOR TOTAL SALIDA ', 1, 0, 'R');
$pdf->Cell(30, 6, number_format($totalsum, 2), 1, 1, 'R');
$pdf->Ln(25);

$valY = $pdf->GetY();
$pdf->Line(20, $valY, 95, $valY);
$pdf->Line(110, $valY, 195, $valY);
$pdf->Cell(95, 6, 'RECIBE', 0, 0, 'C');
$pdf->Cell(5, 6, '', 0, 0, 'L');
$pdf->Cell(95, 6, 'ENTREGA', 0, 0, 'C');

$pdf->Ln(5);
$file = '../../imprimir/Salida_' . $numeroMov . '.pdf';

$pdf->Output($file, 'F');

echo $numeroSal;
