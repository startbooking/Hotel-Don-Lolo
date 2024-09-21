<?php

require '../../../res/fpdf/fpdf.php';

$numero = $_SESSION['abono'];
$deposito = $hotel->getInformacionAbono($numero);
$datosReserva = $hotel->getReservasDatos($deposito[0]['numero_reserva']);
$datosHuesped = $hotel->getbuscaDatosHuesped($deposito[0]['id_huesped']);
$tipoHabitacion = $hotel->getNombreTipoHabitacion($datosReserva[0]['tipo_habitacion']);
$fecha = $hotel->getDatePms();

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Rect(10, 55, 190, 77);
$pdf->Image('../../../img/'.LOGO, xPOS, yPOS, tPOS); 
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 5, NAME_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 4, 'NIT: '.NIT_EMPRESA, 0, 1, 'C');
$pdf->Cell(190, 4, REGIMEN, 0, 1, 'C');
$pdf->Cell(190, 4, ADRESS_EMPRESA, 0, 1, 'C');
$pdf->Cell(190, 4, CIUDAD_EMPRESA.' '.PAIS_EMPRESA, 0, 1, 'C');
$pdf->Cell(40, 4, '', 0, 0, 'C');
$pdf->Cell(110, 4, 'Telefono '.TELEFONO_EMPRESA.' Movil '.CELULAR_EMPRESA, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 4, 'ABONO A CUENTA HUESPED ', 0, 1, 'C');
$pdf->Ln(1);
$pdf->Cell(30, 5, 'Abono Nro ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(15, 5, str_pad($numero, 5, '0', STR_PAD_LEFT), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 5, 'FECHA ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(40, 5, date('Y-m-d H:i:s'), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, 'Nro Reserva ', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(30, 5, $datosReserva[0]['num_reserva'], 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, 'HUESPED', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(80, 5, substr($datosHuesped[0]['apellido1'].' '.$datosHuesped[0]['apellido2'].' '.$datosHuesped[0]['nombre1'].' '.$datosHuesped[0]['nombre2'], 0, 35), 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 5, 'IDENTIFICACION', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(25, 5, $datosHuesped[0]['identificacion'], 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 5, 'HABITACION', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(10, 5, $datosReserva[0]['num_habitacion'], 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 5, 'FECHA LLEGADA', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, $datosReserva[0]['fecha_llegada'], 0, 0, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(35, 5, 'FECHA SALIDA', 0, 0, 'L');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(20, 5, $datosReserva[0]['fecha_salida'], 0, 1, 'L');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(100, 5, 'DETALLE', 1, 0, 'C');
$pdf->Cell(90, 5, 'VALOR', 1, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(100, 5, $deposito[0]['descripcion_cargo'], 0, 0, 'L');
$pdf->Cell(90, 5, number_format($deposito[0]['pagos_cargos'], 2), 0, 1, 'R');

$pdf->Sety(90);
$pdf->Cell(45, 5, 'Informacion Abono ', 1, 0, 'J');
$pdf->Cell(145, 5, $deposito[0]['informacion_cargo'], 1, 1, 'J');
$pdf->Cell(45, 5, 'Referencia Abono ', 1, 0, 'J');
$pdf->Cell(145, 5, $deposito[0]['referencia_cargo'], 1,1, 'J');
$pdf->Cell(190, 5, 'SON :'.numtoletras($deposito[0]['pagos_cargos']), 1, 1, 'L');
$pdf->Cell(100, 5, 'Firma', 0, 0, 'C');
$pdf->Cell(92, 5, 'Firma', 0, 1, 'C');
$pdf->Ln(12);
$pdf->Rect(10, 100, 100, 27);

$pdf->Cell(50, 5, 'Nombre', 0, 0, 'C');
$pdf->Cell(50, 5, 'Identificacion', 0, 0, 'C');
$pdf->Cell(45, 5, 'Nombre', 0, 0, 'C');
$pdf->Cell(45, 5, 'Identificacion', 0, 1, 'C');
$pdf->Cell(100, 5, 'CAJERO', 1, 0, 'C');
$pdf->Cell(90, 5, 'CAJERO '.$usuario, 1, 1, 'C');

$y = $pdf->GetY();
$pdf->SetY(115);
$pdf->SetX(10);

$file = '../../imprimir/notas/Abono_'.$numero.'.pdf';

$pdf->Output($file, 'F');

echo $numero;
