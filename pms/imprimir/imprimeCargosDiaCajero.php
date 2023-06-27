<?php

$file = $_POST['file'];
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];

require_once '../../res/php/app_topHotel.php';
require_once '../imprimir/plantillaFpdf.php';

if (file_exists('imprimir/informes/Informes_cajeros_'.$usuario.'.pdf')) {
    unlink('imprimir/informes/Informes_cajeros_'.$usuario.'.pdf');
}

$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(195, 5, 'BALANCE CAJERO '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'CARGOS DEL DIA ', 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(30, 6, 'Usuario ', 0, 0, 'L');
$pdf->Cell(50, 6, $apellidos.' '.$nombres, 0, 1, 'C');
$pdf->Ln(2);
$pdf->Cell(10, 6, 'Hab.', 0, 0, 'C');
$pdf->Cell(50, 6, 'Huesped', 0, 0, 'C');
$pdf->Cell(40, 6, 'Descripcion ', 0, 0, 'C');
$pdf->Cell(10, 6, 'Cant. ', 0, 0, 'C');
$pdf->Cell(25, 6, 'Monto', 0, 0, 'C');
$pdf->Cell(25, 6, 'Impuesto', 0, 0, 'C');
$pdf->Cell(25, 6, 'Total', 0, 0, 'C');
$pdf->Cell(10, 6, 'Hora', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS, $usuario, 1, 0);
$monto = 0;
$impto = 0;
$total = 0;
foreach ($cargos as $cargo) {
    $pdf->Cell(10, 6, $cargo['habitacion_cargo'], 0, 0, 'L');
    $pdf->Cell(50, 6, substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 24), 0, 0, 'L');
    $pdf->Cell(40, 6, substr(utf8_decode($cargo['descripcion_cargo']), 0, 19), 0, 0, 'L');
    $pdf->Cell(10, 6, $cargo['cantidad_cargo'], 0, 0, 'C');
    $pdf->Cell(25, 6, number_format($cargo['monto_cargo'], 2), 0, 0, 'R');
    $pdf->Cell(25, 6, number_format($cargo['impuesto'], 2), 0, 0, 'R');
    $pdf->Cell(25, 6, number_format($cargo['monto_cargo'] + $cargo['impuesto'], 2), 0, 0, 'R');
    $pdf->Cell(10, 6, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
    $monto = $monto + $cargo['monto_cargo'];
    $impto = $impto + $cargo['impuesto'];
    $total = $total + $cargo['monto_cargo'] + $cargo['impuesto'];
}
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(110, 6, 'Total cargos Por Cajero ', 0, 0, 'L');
$pdf->Cell(25, 6, number_format($monto, 2), 0, 0, 'R');
$pdf->Cell(25, 6, number_format($impto, 2), 0, 0, 'R');
$pdf->Cell(25, 6, number_format($total, 2), 0, 1, 'R');
$pdf->Ln(3);

$fileOut = '../imprimir/informes/'.$file.'.pdf';
$pdf->Output($fileOut, 'F');
echo $file.'.pdf';
