<?php
// require 'plantillaAuditoria.php';

$reservas = $hotel->getReservasDia(FECHA_PMS, 1, "ES");
$regis    = count($reservas);

$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(190, 5, 'REPORTE DE NO SHOWS DEL DIA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 5, 'Fecha ' . FECHA_PMS, 0, 1, 'C');
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 6, 'Reserva ', 0, 0, 'C');
$pdf->Cell(30, 6, 'Fecha Llegada', 0, 0, 'L');
$pdf->Cell(30, 6, 'Fecha Salida', 0, 0, 'L');
$pdf->Cell(70, 6, 'Huesped', 0, 0, 'L');
$pdf->Cell(5, 6, 'H', 0, 0, 'L');
$pdf->Cell(5, 6, 'M', 0, 0, 'L');
$pdf->Cell(5, 6, 'N', 0, 0, 'L');
$pdf->Cell(25, 6, 'Tarifa', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
if ($regis == 0) {
  $pdf->Cell(190, 6, 'SIN NO SHOWS PARA ESTE DIA', 0, 0, 'C');
} else {
  foreach ($reservas as $reserva) {
    $pdf->Cell(20, 6, $reserva['num_reserva'], 0, 0, 'C');
    $pdf->Cell(30, 6, $reserva['fecha_llegada'], 0, 0, 'L');
    $pdf->Cell(30, 6, $reserva['fecha_salida'], 0, 0, 'L');
    $pdf->Cell(70, 6, $reserva['apellido1'] . ' ' . $reserva['apellido2'] . ' ' . $reserva['nombre1'] . ' ' . $reserva['nombre2'], 0, 0, 'L');
    $pdf->Cell(5, 6, $reserva['can_hombres'], 0, 0, 'C');
    $pdf->Cell(5, 6, $reserva['can_mujeres'], 0, 0, 'C');
    $pdf->Cell(5, 6, $reserva['can_ninos'], 0, 0, 'C');
    $pdf->Cell(25, 6, number_format($reserva['valor_diario'], 2), 0, 1, 'R');
  }
}

$file = '../../imprimir/auditorias/NoShows_' . FECHA_PMS . '.pdf';
$pdf->Output($file, 'F');
