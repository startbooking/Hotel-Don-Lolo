<?php

$file = $_POST['file'];
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];

require_once '../../res/php/app_topHotel.php';
require_once '../imprimir/plantillaFpdfFinanc.php';

$depositos = $hotel->getDepositosdelDia(FECHA_PMS, 3, 0);

$regis = count($depositos);

$pdf = new PDF();
$pdf->AddPage('L', 'letter');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(265, 5, 'RECIBOS DE CAJA DEL DIA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(265, 5, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 6, 'Deposito. ', 0, 0, 'C');
$pdf->Cell(30, 6, 'Valor ', 0, 0, 'C');
$pdf->Cell(10, 6, 'Hab. ', 0, 0, 'C');
$pdf->Cell(70, 6, 'Forma de Pago ', 0, 0, 'C');
$pdf->Cell(20, 6, 'Reserva ', 0, 0, 'C');
$pdf->Cell(70, 6, 'Huesped', 0, 0, 'C');
$pdf->Cell(20, 6, 'Fecha', 0, 0, 'C');
$pdf->Cell(20, 6, 'Usuario', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(2);

if ($regis == 0) {
    $pdf->Cell(260, 6, 'SIN RECIBOS DE CAJA ', 0, 0, 'C');
} else {
    $sal = 0;
    foreach ($depositos as $deposito) {
        $pdf->Cell(20, 5, $deposito['concecutivo_abono'], 0, 0, 'R');
        $pdf->Cell(30, 5, number_format($deposito['pagos_cargos'], 2), 0, 0, 'R');
        $pdf->Cell(10, 5, $deposito['habitacion_cargo'], 0, 0, 'R');
        $pdf->Cell(70, 5, $deposito['descripcion_cargo'], 0, 0, 'L');
        $pdf->Cell(20, 5, $deposito['id_reserva'], 0, 0, 'C');
        $pdf->Cell(70, 5, utf8_decode($deposito['apellido1'].' '.$deposito['apellido2'].' '.$deposito['nombre1'].' '.$deposito['nombre2']), 0, 0, 'L');
        $pdf->Cell(20, 5, $deposito['fecha_cargo'], 0, 0, 'R');
        $pdf->Cell(20, 5, utf8_decode($hotel->nombreUsuario($deposito['id_usuario'])), 0, 1, 'L');
        $sal = $sal + $deposito['pagos_cargos'];
    }
    $pdf->SetY(180);
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(160, 6, 'Total Depositos', 0, 0, 'C');
    $pdf->Cell(30, 6, number_format($sal, 2), 0, 1, 'R');
}
$fileOut = '../imprimir/informes/'.$file.'.pdf';
$pdf->Output($fileOut, 'F');
echo $file.'.pdf';
