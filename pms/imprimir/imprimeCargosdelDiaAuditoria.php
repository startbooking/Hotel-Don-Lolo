<?php

$pdf = new PDF();
$pdf->AddPage('L', 'letter');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(260, 4, 'CARGOS DEL DIA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(260, 4, 'Fecha : '.FECHA_PMS, 0, 1, 'C');

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 5, 'Hab.', 1, 0, 'C');
$pdf->Cell(70, 5, 'Huesped', 1, 0, 'C');
$pdf->Cell(50, 5, 'Descripcion ', 1, 0, 'C');
$pdf->Cell(10, 5, 'Cant. ', 1, 0, 'C');
$pdf->Cell(25, 5, 'Monto', 1, 0, 'C');
$pdf->Cell(25, 5, 'Impuesto', 1, 0, 'C');
$pdf->Cell(25, 5, 'Total', 1, 0, 'C');
$pdf->Cell(30, 5, 'Usuario', 1, 0, 'C');
$pdf->Cell(10, 5, 'Hora', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$cargos = $hotel->getCargosporFecha(FECHA_PMS, 1, 0);

$monto = 0;
$impto = 0;
$total = 0;
foreach ($cargos as $cargo) {
    $pdf->Cell(10, 4, $cargo['habitacion_cargo'], 0, 0, 'L');
    $pdf->Cell(70, 4, substr(($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 34), 0, 0, 'L');
    $pdf->Cell(50, 4, substr(($cargo['descripcion_cargo']), 0, 25), 0, 0, 'L');
    $pdf->Cell(10, 4, $cargo['cantidad_cargo'], 0, 0, 'C');
    $pdf->Cell(25, 4, number_format($cargo['monto_cargo'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($cargo['impuesto'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($cargo['monto_cargo'] + $cargo['impuesto'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, $cargo['usuario'], 0, 0, 'R');
    $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
    $monto = $monto + $cargo['monto_cargo'];
    $impto = $impto + $cargo['impuesto'];
    $total = $total + $cargo['monto_cargo'] + $cargo['impuesto'];
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(140, 4, 'Total cargos del Dia ', 0, 0, 'L');
$pdf->Cell(25, 4, number_format($monto, 2), 0, 0, 'R');
$pdf->Cell(25, 4, number_format($impto, 2), 0, 0, 'R');
$pdf->Cell(25, 4, number_format($total, 2), 0, 1, 'R');
$pdf->Ln(3);

$file = '../../imprimir/auditorias/cargosDelDia_'.FECHA_PMS.'.pdf';
$pdf->Output($file,'F');
