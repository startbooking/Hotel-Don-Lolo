<?php
$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(195, 5, 'FLUJO DE CAJA', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(195, 5, 'Fecha : ' . FECHA_PMS, 0, 1, 'C');
$mon   = 0;
$monto = 0;

$pdf->SetFont('Arial', '', 8);
$codigos = $hotel->cargosDelDia(FECHA_PMS, 3, 0);

$pag = 0;
$monto = 0;

$pdf->Cell(20, 5, 'Numero', 1, 0, 'R');
$pdf->Cell(20, 5, 'Hab.', 1, 0, 'R');
$pdf->Cell(70, 5, 'Huesped', 1, 0, 'C');
$pdf->Cell(10, 5, 'Cant. ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Pago', 1, 0, 'C');
$pdf->Cell(30, 5, 'Usuario', 1, 0, 'C');
$pdf->Cell(10, 5, 'Hora', 1, 1, 'C');

foreach ($codigos as $codigo) {
  $pdf->Cell(40, 5, 'Forma de Pago ', 0, 0, 'L');
  $pdf->SetFont('Arial', 'B', 8);
  $pdf->Cell(50, 5, ($codigo['descripcion_cargo']), 0, 1, 'L');
  $pdf->SetFont('Arial', '', 8);
  $cargos = $hotel->getCargosdelDiaporCodigo(FECHA_PMS, $codigo['id_codigo_cargo'], 0);
  $pdf->SetFont('Arial', '', 8);
  $pagos = 0;

  foreach ($cargos as $cargo) {
    if ($cargo['factura_numero'] == 0) {
      $numDoc = $cargo['concecutivo_abono'];
    } else {
      $numDoc = $cargo['factura_numero'];
    }
    $pdf->Cell(20, 4, $numDoc, 0, 0, 'R');
    $pdf->Cell(20, 4, $cargo['habitacion_cargo'], 0, 0, 'R');
    $pdf->Cell(70, 4, substr(($cargo['apellido1'] . ' ' . $cargo['apellido2'] . ' ' . $cargo['nombre1'] . ' ' . $cargo['nombre2']), 0, 24), 0, 0, 'L');
    $pdf->Cell(10, 4, $cargo['cantidad_cargo'], 0, 0, 'C');
    $pdf->Cell(25, 4, number_format($cargo['pagos_cargos'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, $cargo['usuario'], 0, 0, 'R');
    $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
    $pagos = $pagos + $cargo['pagos_cargos'];
  }
  $pag = $pag + $pagos;

  $pdf->SetFont('Arial', '', 8);
  $pdf->Cell(120, 4, ($cargo['descripcion_cargo']), 0, 0, 'L');
  $pdf->Cell(25, 4, number_format($pagos, 2), 0, 1, 'R');
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(120, 5, 'Total Pagos Del Dia', 0, 0, 'L');
$pdf->Cell(25, 5, number_format($pag, 2), 0, 0, 'R');
$recaudos = $hotel->traeRecaudosCartera();
$pag = 0;
$monto = 0;

$pdf->Cell(160, 5, 'RECAUDOS DE CARTERA DEL DIA', 0, 1, 'L');
$pdf->SetFont('Arial', '', 8);

$pdf->Cell(20, 5, 'Numero', 1, 0, 'C');
$pdf->Cell(20, 5, 'Fecha Pago', 1, 0, 'C');
$pdf->Cell(100, 5, 'Empresa.', 1, 0, 'C');
$pdf->Cell(20, 5, 'Valor', 1, 0, 'C');
$pdf->Cell(20, 5, 'Usuario ', 1, 1, 'C');

foreach ($recaudos as $codigo) {
  $pdf->Cell(20, 4, $codigo['numeroRecaudo'], 0, 0, 'L');
  $pdf->Cell(20, 4, substr($codigo['fechaRecaudo'],0,50), 0, 0, 'L');
  $pdf->Cell(100, 4, substr($codigo['empresa'], 0, 50), 0, 0, 'L');
  $pdf->Cell(20, 4, number_format($codigo['totalRecaudo'], 2), 0, 0, 'R');
  $pdf->Cell(20, 4, $codigo['usuario'], 0, 1, 'L');
  $pag = $pag + $codigo['totalRecaudo'];
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 8);
$pdf->Cell(120, 5, 'Total Recaudos Del Dia', 1, 0, 'L');
$pdf->Cell(20, 5, number_format($pag, 2), 1, 1, 'R');
$pdf->Ln(3);

$file = '../../imprimir/auditorias/flujodeCaja_' . FECHA_PMS . '.pdf';
$pdf->Output($file, 'F');
