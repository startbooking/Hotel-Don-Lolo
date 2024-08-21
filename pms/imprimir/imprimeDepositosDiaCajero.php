<?php

$file = $_POST['file'];
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];

require_once '../../res/php/app_topHotel.php';
require_once '../imprimir/plantillaFpdf.php';

$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(195, 5, 'BALANCE CAJERO '.FECHA_PMS, 0, 1, 'C');
// $pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'DEPOSITOS DEL DIA ', 0, 1, 'C');
// $pdf->Ln(1);
$pdf->Cell(30, 5, 'Usuario ', 0, 0, 'L');
$pdf->Cell(50, 5, $apellidos.' '.$nombres, 0, 1, 'C');
// $pdf->Ln(2);
$pdf->Cell(10, 5, 'Hab.', 0, 0, 'C');
$pdf->Cell(10, 5, 'Nro.', 0, 0, 'C');
$pdf->Cell(70, 5, 'Huesped', 0, 0, 'C');
$pdf->Cell(50, 5, 'Descripcion ', 0, 0, 'C');
$pdf->Cell(25, 5, 'Valor', 0, 0, 'C');
$pdf->Cell(10, 5, 'Hora', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$cargos = $hotel->getDepositosdelDiaporcajero(FECHA_PMS, $usuario, 3, 0);

$pagos = 0;
foreach ($cargos as $cargo) {
    $pdf->Cell(10, 4, $cargo['habitacion_cargo'], 0, 0, 'L');
    $pdf->Cell(10, 4, $cargo['concecutivo_abono'], 0, 0, 'L');
    $pdf->Cell(70, 4, substr(($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 35), 0, 0, 'L');
    $pdf->Cell(50, 4, ($cargo['descripcion_cargo']), 0, 0, 'L');
    $pdf->Cell(25, 4, number_format($cargo['pagos_cargos'], 2), 0, 0, 'R');
    $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
    $pagos = $pagos + $cargo['pagos_cargos'];
}
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(140, 5, 'Total Pagos Por Cajero ', 0, 0, 'L');
$pdf->Cell(25, 5, number_format($pagos, 2), 0, 1, 'R');

$pdf->Ln(5);

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;


