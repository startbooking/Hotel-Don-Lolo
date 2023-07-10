<?php

$file = $_POST['file'];
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];

require_once '../../res/php/app_topHotel.php';
require_once '../imprimir/plantillaFpdfFinanc.php';

$pdf = new PDF();
$pdf->AddPage('L', 'letter');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(260, 5, 'CARGOS DEL DIA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(260, 5, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(10, 6, 'Hab.', 0, 0, 'C');
$pdf->Cell(70, 6, 'Huesped', 0, 0, 'C');
$pdf->Cell(50, 6, 'Descripcion ', 0, 0, 'C');
$pdf->Cell(10, 6, 'Cant. ', 0, 0, 'C');
$pdf->Cell(25, 6, 'Monto', 0, 0, 'C');
$pdf->Cell(25, 6, 'Impuesto', 0, 0, 'C');
$pdf->Cell(25, 6, 'Total', 0, 0, 'C');
$pdf->Cell(30, 6, 'Usuario', 0, 0, 'C');
$pdf->Cell(10, 6, 'Hora', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$cargos = $hotel->getCargosporFecha(FECHA_PMS, 1, 0);

// echo json_encode($cargos);

$monto = 0;
$impto = 0;
$total = 0;
foreach ($cargos as $cargo) {
    $pdf->Cell(10, 6, $cargo['habitacion_cargo'], 0, 0, 'L');
    $pdf->Cell(70, 6, substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 34), 0, 0, 'L');
    $pdf->Cell(50, 6, substr(utf8_decode($cargo['descripcion_cargo']), 0, 25), 0, 0, 'L');
    $pdf->Cell(10, 6, $cargo['cantidad_cargo'], 0, 0, 'C');
    $pdf->Cell(25, 6, number_format($cargo['monto_cargo'], 2), 0, 0, 'R');
    $pdf->Cell(25, 6, number_format($cargo['impuesto'], 2), 0, 0, 'R');
    $pdf->Cell(25, 6, number_format($cargo['monto_cargo'] + $cargo['impuesto'], 2), 0, 0, 'R');
    $pdf->Cell(30, 6, $cargo['usuario'], 0, 0, 'R');
    $pdf->Cell(10, 6, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
    $monto = $monto + $cargo['monto_cargo'];
    $impto = $impto + $cargo['impuesto'];
    $total = $total + $cargo['monto_cargo'] + $cargo['impuesto'];
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(140, 6, 'Total cargos del Dia ', 0, 0, 'L');
$pdf->Cell(25, 6, number_format($monto, 2), 0, 0, 'R');
$pdf->Cell(25, 6, number_format($impto, 2), 0, 0, 'R');
$pdf->Cell(25, 6, number_format($total, 2), 0, 1, 'R');
$pdf->Ln(3);

$fileOut = '../imprimir/informes/'.$file.'.pdf';
$pdf->Output($fileOut, 'F');
echo $file.'.pdf';
