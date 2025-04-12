<?php
$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'CARGOS DEL DIA POR HABITACION', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 5, 'Fecha ' . FECHA_PMS, 0, 1, 'C');
$pdf->Ln(1);
$encasas = $hotel->getHuespedesenCasa(2, 'CA');
$regis   = count($encasas);

if ($regis == 0) {
  $pdf->Cell(195, 6, 'SIN HUESPEDES ALOJADOS ESTE DIA ' . FECHA_PMS, 0, 1, 'C');
} else {
  foreach ($encasas as $encasa) {
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->Cell(20, 5, 'Huesped ', 1, 0, 'L');
    $pdf->Cell(70, 5, (substr($encasa['apellido1'] . ' ' . $encasa['apellido2'] . ' ' . $encasa['nombre1'] . ' ' . $encasa['nombre2'], 0, 25)), 1, 0, 'L');
    $pdf->Cell(10, 5, 'Hab ', 1, 0, 'L');
    $pdf->Cell(10, 5, $encasa['num_habitacion'], 1, 1, 'C');
    /* $pdf->Cell(10, 5, 'Tipo ', 0, 0, 'L');
    $pdf->Cell(10, 5, $encasa['tipo_habitacion'], 0, 0, 'C');
    $pdf->Cell(10, 5, 'Tarifa ', 0, 0, 'L');
    $pdf->Cell(30, 5, number_format($encasa['valor_diario'], 2), 0, 1, 'C'); */
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(60, 5, 'Descripcion ', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Cant. ', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Monto', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Impuesto', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Total', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Pagos', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Hora', 0, 1, 'C');
    $cargos = $hotel->getCargosdelDiaporReserva(FECHA_PMS, $encasa['num_reserva']);
    $regis1 = count($cargos);
    $monto  = 0;
    if ($regis1 <> 0) {
      $impto  = 0;
      $total  = 0;
      $pagos  = 0;
      foreach ($cargos as $cargo) {
        $pdf->Cell(60, 4, $cargo['descripcion_cargo'], 0, 0, 'L');
        $pdf->Cell(10, 4, $cargo['cantidad_cargo'], 0, 0, 'C');
        $pdf->Cell(25, 4, number_format($cargo['monto_cargo'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($cargo['impuesto'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($cargo['monto_cargo'] + $cargo['impuesto'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($cargo['pagos_cargos'], 2), 0, 0, 'R');
        $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
        $monto = $monto + $cargo['monto_cargo'];
        $impto = $impto + $cargo['impuesto'];
        $total = $total + $cargo['monto_cargo'] + $cargo['impuesto'];
        $pagos = $pagos + $cargo['pagos_cargos'];
      }
      $pdf->SetFont('Arial', 'B', 9);
      $pdf->Cell(70, 4, 'Total cargos Por Huesped ', 0, 0, 'L');
      $pdf->Cell(25, 4, number_format($monto, 2), 0, 0, 'R');
      $pdf->Cell(25, 4, number_format($impto, 2), 0, 0, 'R');
      $pdf->Cell(25, 4, number_format($total, 2), 0, 0, 'R');
      $pdf->Cell(25, 4, number_format($pagos, 2), 0, 1, 'R');
    } else {
      $pdf->SetFont('Arial', '', 9);
      $pdf->Cell(195, 6, 'SIN CARGOS EN EL DIA PARA ESTE HUESPEDES ', 0, 1, 'C');
    }
    $pdf->Ln(3);
  }
}

$file = '../../imprimir/auditorias/Balance_Diario_Huesped_' . FECHA_PMS . '.pdf';
$pdf->Output($file, 'F');
