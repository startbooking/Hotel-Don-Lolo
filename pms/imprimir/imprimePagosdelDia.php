<?php

$file = $_POST['file'];
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];

require_once '../../res/php/app_topHotel.php';
require_once '../imprimir/plantillaFpdf.php';

$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(195, 5, 'PAGOS DEL DIA', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(195, 5, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(2);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 5, 'Hab.', 1, 0, 'C');
$pdf->Cell(50, 5, 'Huesped', 1, 0, 'C');
$pdf->Cell(40, 5, 'Descripcion ', 1, 0, 'C');
$pdf->Cell(10, 5, 'Doc', 1, 0, 'C');
$pdf->Cell(20, 5, 'Reserva', 1, 0, 'C');
$pdf->Cell(20, 5, 'Pagos', 1, 0, 'C');
$pdf->Cell(20, 5, 'Usuario', 1, 0, 'C');
$pdf->Cell(10, 5, 'Hora', 1, 0, 'C');
$pdf->Cell(15, 5, 'Estado', 1, 1, 'C');
$pdf->SetFont('Arial', '', 8);
$cargos = $hotel->getCargosporFecha(FECHA_PMS, 3, 0);

$pagos = 0;
$impto = 0;
$total = 0;

foreach ($cargos as $cargo) {
    if ($cargo['factura_numero'] == 0) {
        $numeroDoc = $cargo['concecutivo_abono'];
    } else {
        $numeroDoc = $cargo['factura_numero'];
    }
    if ($cargo['factura_anulada'] == 0) {
        $estadoFa = 'Activa';
    } else {
        $estadoFa = 'Anulada';
    }
    $pdf->Cell(10, 4, $cargo['habitacion_cargo'], 0, 0, 'L');
    $pdf->Cell(50, 4, substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 28), 0, 0, 'L');
    $pdf->Cell(40, 4, substr(utf8_decode($cargo['descripcion_cargo']), 0, 19), 0, 0, 'L');
    $pdf->Cell(10, 4, $numeroDoc, 0, 0, 'R');
    $pdf->Cell(20, 4, $cargo['numero_reserva'], 0, 0, 'R');
    $pdf->Cell(20, 4, number_format($cargo['pagos_cargos'], 2), 0, 0, 'R');
    $pdf->Cell(20, 4, $cargo['usuario'], 0, 0, 'R');
    $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 0, 'R');
    $pdf->Cell(15, 4, utf8_decode($estadoFa), 0, 1, 'R');
    $pagos = $pagos + $cargo['pagos_cargos'];
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(124, 5, 'Total Pagos del Dia ', 1, 0, 'L');
$pdf->Cell(25, 5, number_format($pagos, 2), 1, 1, 'R');
$pdf->Ln(3);

  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;