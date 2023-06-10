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
$pdf->Cell(260, 5, 'PAGOS ANULADOS DEL DIA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(260, 5, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 6, 'Nro Doc.', 0, 0, 'C');
$pdf->Cell(10, 6, 'Hab.', 0, 0, 'C');
$pdf->Cell(50, 6, 'Huesped', 0, 0, 'C');
$pdf->Cell(40, 6, 'Descripcion ', 0, 0, 'C');
$pdf->Cell(25, 6, 'Pago', 0, 0, 'C');
$pdf->Cell(60, 6, 'Motivo Anulacion', 0, 0, 'C');
$pdf->Cell(20, 6, 'Usuario', 0, 0, 'C');
// $pdf->Cell(1, 6, 'FAC', 0, 0, 'C');
$pdf->Cell(10, 6, 'Hora', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$cargos = $hotel->getCargosAnuladosporFecha(FECHA_PMS, 3, 1);

// echo print_r($cargos);

$pago = 0;
foreach ($cargos as $cargo) {
    if ($cargo['factura_numero'] == 0) {
        $numDoc = $cargo['concecutivo_abono'];
    } else {
        $numDoc = $cargo['factura_numero'];
    }
    $pdf->Cell(20, 4, $numDoc, 0, 0, 'R');
    $pdf->Cell(10, 4, $cargo['habitacion_cargo'], 0, 0, 'R');
    $pdf->Cell(50, 4, substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 22), 0, 0, 'L');
    $pdf->Cell(40, 4, substr(utf8_decode($cargo['descripcion_cargo']), 0, 19), 0, 0, 'L');
    $pdf->Cell(25, 4, number_format($cargo['pagos_cargos'], 2), 0, 0, 'R');
    $pdf->Cell(60, 4, substr(utf8_decode($cargo['motivo_anulacion']), 0, 24), 0, 0, 'L');
    $pdf->Cell(20, 4, $cargo['usuario'], 0, 0, 'L');
    // $pdf->Cell(10, 4, $cargo['factura_numero'], 0, 0, 'R');
    $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
    $pago = $pago + $cargo['pagos_cargos'];
}
$pdf->Ln(2);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(100, 6, 'Total Pagos Anulados del Dia ', 0, 0, 'L');
$pdf->Cell(25, 6, number_format($pago, 2), 0, 1, 'R');
$pdf->Ln(3);

$fileOut = '../imprimir/informes/'.$file.'.pdf';
$pdf->Output($fileOut, 'F');
echo $file.'.pdf';
