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
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(265, 4, 'RECIBOS DE CAJA DEL DIA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(265, 4, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
// $pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(20, 5, 'Deposito. ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Reserva. ', 1, 0, 'C');
$pdf->Cell(30, 5, 'Valor ', 1, 0, 'C');
$pdf->Cell(10, 5, 'Hab. ', 1, 0, 'C');
$pdf->Cell(50, 5, 'Forma de Pago ', 1, 0, 'C');
$pdf->Cell(20, 5, 'Reserva ', 1, 0, 'C');
$pdf->Cell(70, 5, 'Huesped', 1, 0, 'C');
$pdf->Cell(20, 5, 'Fecha', 1, 0, 'C');
$pdf->Cell(20, 5, 'Usuario', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(2);

if ($regis == 0) {
    $pdf->Cell(260, 6, 'SIN RECIBOS DE CAJA ', 0, 0, 'C');
} else {
    $sal = 0;
    foreach ($depositos as $deposito) {
        $pdf->Cell(20, 4, $deposito['concecutivo_abono'], 0, 0, 'R');
        $pdf->Cell(20, 4, $deposito['numero_reserva'], 0, 0, 'R');
        $pdf->Cell(30, 4, number_format($deposito['pagos_cargos'], 2), 0, 0, 'R');
        $pdf->Cell(10, 4, $deposito['habitacion_cargo'], 0, 0, 'R');
        $pdf->Cell(50, 4, $deposito['descripcion_cargo'], 0, 0, 'L');
        $pdf->Cell(20, 4, $deposito['id_reserva'], 0, 0, 'C');
        $pdf->Cell(70, 4, ($deposito['apellido1'].' '.$deposito['apellido2'].' '.$deposito['nombre1'].' '.$deposito['nombre2']), 0, 0, 'L');
        $pdf->Cell(20, 4, $deposito['fecha_cargo'], 0, 0, 'R');
        $pdf->Cell(20, 4, ($hotel->nombreUsuario($deposito['id_usuario'])), 0, 1, 'L');
        $sal = $sal + $deposito['pagos_cargos'];
    }
    // $pdf->SetY(180);
    $pdf->Ln(2);
    
    $pdf->SetFont('Arial', '', 9);
    $pdf->Cell(40, 5, 'Total Depositos', 1, 0, 'L');
    $pdf->Cell(30, 5, number_format($sal, 2), 1, 1, 'R');
}

  $pdfFile = $pdf->Output('', 'S');
  $base64String = chunk_split(base64_encode($pdfFile));

  echo $base64String;

