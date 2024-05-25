<?php

$file = $_POST['file'];
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];

require_once '../../res/php/app_topHotel.php';
require_once '../imprimir/plantillaFpdf.php';


$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'BALANCE CAJERO '.FECHA_PMS, 0, 1, 'C');
// $pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'CARGOS DEL DIA ', 0, 1, 'C');
// $pdf->Ln(1);
$pdf->Cell(30, 5, 'Usuario ', 0, 0, 'L');
$pdf->Cell(50, 5, $apellidos.' '.$nombres, 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(10, 5, 'Hab.', 0, 0, 'C');
$pdf->Cell(50, 5, 'Huesped', 0, 0, 'C');
$pdf->Cell(40, 5, 'Descripcion ', 0, 0, 'C');
$pdf->Cell(10, 5, 'Cant. ', 0, 0, 'C');
$pdf->Cell(25, 5, 'Monto', 0, 0, 'C');
$pdf->Cell(25, 5, 'Impuesto', 0, 0, 'C');
$pdf->Cell(25, 5, 'Total', 0, 0, 'C');
$pdf->Cell(10, 5, 'Hora', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS, $usuario, 1, 0);
$monto = 0;
$impto = 0;
$total = 0;

foreach ($cargos as $cargo) {
    $pdf->Cell(10, 4, $cargo['habitacion_cargo'], 0, 0, 'L');
    $pdf->Cell(50, 4, substr(utf8_decode($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 24), 0, 0, 'L');
    $pdf->Cell(40, 4, substr(utf8_decode($cargo['descripcion_cargo']), 0, 19), 0, 0, 'L');
    $pdf->Cell(10, 4, $cargo['cantidad_cargo'], 0, 0, 'C');
    $pdf->Cell(25, 4, number_format($cargo['monto_cargo'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($cargo['impuesto'], 2), 0, 0, 'R');
    $pdf->Cell(25, 4, number_format($cargo['monto_cargo'] + $cargo['impuesto'], 2), 0, 0, 'R');
    $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
    $monto = $monto + $cargo['monto_cargo'];
    $impto = $impto + $cargo['impuesto'];
    $total = $total + $cargo['monto_cargo'] + $cargo['impuesto'];
}
$pdf->ln(1);
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(110, 4, 'Total cargos Por Cajero ', 0, 0, 'L');
$pdf->Cell(25, 4, number_format($monto, 2), 0, 0, 'R');
$pdf->Cell(25, 4, number_format($impto, 2), 0, 0, 'R');
$pdf->Cell(25, 4, number_format($total, 2), 0, 1, 'R');
$pdf->Ln(3);


$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;


/* echo $file;
// $fileOut = '../imprimir/informes/'.$file.'.pdf';
$pdf->Output($fileOut, 'F');
echo $file.'.pdf';
 */