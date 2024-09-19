<?php

// require 'plantillaAuditoria.php';

$reservas = $hotel->getHuespedesenCasa(2, 'CA');
$TotRooms = count($hotel->cantidadHabitaciones(1));
// $rooms = count($room); 
/* $canford = $hotel->getHabitacionsBloqueadas('FO');
$canfser = $hotel->getHabitacionsBloqueadas('FS'); */
$habMmto = count($hotel->traeHabitacionesMmtoDia(1));
$habDisp = $TotRooms - $habMmto ;
$regis = count($reservas);

$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 5, 'HUESPEDES EN CASA', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(190, 5, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 5, 'Hab.', 0, 0, 'C');
$pdf->Cell(70, 5, 'Huesped', 0, 0, 'C');
$pdf->Cell(25, 5, 'Llegada', 0, 0, 'C');
$pdf->Cell(25, 5, 'Salida', 0, 0, 'C');
$pdf->Cell(10, 5, 'Noc', 0, 0, 'C');
$pdf->Cell(10, 5, 'H', 0, 0, 'C');
$pdf->Cell(10, 5, 'M', 0, 0, 'C');
$pdf->Cell(10, 5, 'N', 0, 0, 'C');
$pdf->Cell(25, 5, 'Tarifa', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$habOcu = 0;
$hom = 0;
$muj = 0;
$nin = 0;
$tar = 0;
if ($regis == 0) {
    $pdf->Cell(190, 6, 'SIN HUESPEDES EN CASA', 0, 1, 'C');
} else {
    foreach ($reservas as $reserva) {
        if ($reserva['causar_impuesto'] == 2) {
            $pdf->Cell(5, 4, 'Exc', 0, 0, 'C');
            $pdf->Cell(10, 4, $reserva['num_habitacion'], 0, 0, 'C');
        } else {
            $pdf->Cell(15, 4, $reserva['num_habitacion'], 0, 0, 'C');
        }
        $pdf->Cell(70, 4, substr(($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']), 0, 30), 0, 0, 'L');
        $pdf->Cell(25, 4, $reserva['fecha_llegada'], 0, 0, 'L');
        $pdf->Cell(25, 4, $reserva['fecha_salida'], 0, 0, 'L');
        $pdf->Cell(10, 4, $reserva['dias_reservados'], 0, 0, 'R');
        $pdf->Cell(10, 4, $reserva['can_hombres'], 0, 0, 'C');
        $pdf->Cell(10, 4, $reserva['can_mujeres'], 0, 0, 'C');
        $pdf->Cell(10, 4, $reserva['can_ninos'], 0, 0, 'C');
        $pdf->Cell(25, 4, number_format($reserva['valor_diario'], 2), 0, 1, 'R');
        if ($reserva['num_habitacion'] <= 2000) {
            $habOcu = $habOcu + 1;
            $hom = $hom + $reserva['can_hombres'];
            $muj = $muj + $reserva['can_mujeres'];
            $nin = $nin + $reserva['can_ninos'];
            $tar = $tar + $reserva['valor_diario'];
        }
    }
}
$pdf->Rect(10, 235, 190, 36);

$pdf->Cell(95, 5, 'Exc. = Huesped con Impuestos Excluidos', 0, 1, 'L');
$pdf->SetY(235);
$pdf->SetFont('Arial', '', 9);

$pdf->Cell(40, 5, 'Habitaciones Disponibles', 1, 0, 'L');
$pdf->Cell(10, 5, $habDisp, 1, 0, 'R');
$pdf->Cell(40, 5, 'Habitaciones Mmto', 1, 0, 'L');
$pdf->Cell(10, 5, $habMmto, 1, 0, 'R');
$pdf->Cell(40, 5, 'Habitaciones Ocupadas', 1, 0, 'L');
$pdf->Cell(10, 5, $habOcu, 1, 0, 'R');
$pdf->Cell(25, 5, '% Ocupacion', 1, 0, 'L');
$pdf->Cell(15, 5, number_format(($habOcu / $habDisp) * 100, 2).' %', 1, 1, 'R');
$pdf->Cell(30, 5, 'Total Huespedes', 1, 0, 'L');
$pdf->Cell(20, 5, $hom + $muj + $nin, 1, 0, 'C');
$pdf->Cell(25, 5, 'Hombres '.$hom, 1, 0, 'C');
$pdf->Cell(25, 5, 'Mujeres '.$muj, 1, 0, 'C');
$pdf->Cell(20, 5, 'Ninos '.$nin, 1, 0, 'C');
$pdf->Cell(40, 5, 'Ingreso Alojamiento', 1, 0, 'L');
$pdf->Cell(30, 5, number_format($tar, 2), 1, 1, 'R');

$pdf->Cell(65, 5, 'Ingreso Promedio por Habitacion Ocupada', 1, 0, 'L');
if ($habOcu == 0) {
    $pdf->Cell(30, 5, number_format($habOcu, 2), 1, 0, 'R');
} else {
    $pdf->Cell(30, 5, number_format(round($tar / $habOcu, 2), 2), 1, 0, 'R');
}
$pdf->Cell(65, 5, 'Ingreso Promedio por Huesped', 1, 0, 'L');
if (($hom + $muj) == 0) {
    $pdf->Cell(30, 5, number_format($hom + $muj, 2), 1, 1, 'R');
} else {
    $pdf->Cell(30, 5, number_format(round($tar / ($hom + $muj), 2), 2), 1, 1, 'R');
}
$pdf->Cell(65, 5, 'Ingreso Promedio por Habitacion Disponibles', 1, 0, 'L');
$pdf->Cell(30, 5, number_format(round($tar / $habDisp, 2), 2), 1, 0, 'R');

$file = '../../imprimir/auditorias/Huespedes_en_Casa_'.FECHA_PMS.'.pdf';
$pdf->Output($file, 'F');
