<?php

// require 'plantillaAuditoria.php';

$reservas = $hotel->getHuespedesenCasa(2, 'CA');
$room = $hotel->cantidadHabitaciones(1);
$rooms = count($room);
$canford = $hotel->getHabitacionsBloqueadas('FO');
$canfser = $hotel->getHabitacionsBloqueadas('FS');
$dispo = $rooms - $canford - $canfser;
$regis = count($reservas);

$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(190, 5, 'HUESPEDES EN CASA', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(190, 5, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(3);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(15, 6, 'Hab.', 0, 0, 'C');
$pdf->Cell(15, 6, 'Tipo Hab. ', 0, 0, 'C');
$pdf->Cell(70, 6, 'Huesped', 0, 0, 'C');
$pdf->Cell(25, 6, 'Llegada', 0, 0, 'C');
$pdf->Cell(25, 6, 'Salida', 0, 0, 'C');
$pdf->Cell(5, 6, 'Noc', 0, 0, 'C');
$pdf->Cell(5, 6, 'H', 0, 0, 'C');
$pdf->Cell(5, 6, 'M', 0, 0, 'C');
$pdf->Cell(5, 6, 'N', 0, 0, 'C');
$pdf->Cell(25, 6, 'Tarifa', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$hab = 0;
$hom = 0;
$muj = 0;
$nin = 0;
$tar = 0;
if ($regis == 0) {
    $pdf->Cell(190, 6, 'SIN HUESPEDES EN CASA', 0, 1, 'C');
} else {
    foreach ($reservas as $reserva) {
        if ($reserva['causar_impuesto'] == 2) {
            $pdf->Cell(5, 6, 'Exc', 0, 0, 'C');
            $pdf->Cell(10, 6, $reserva['num_habitacion'], 0, 0, 'C');
        } else {
            $pdf->Cell(15, 6, $reserva['num_habitacion'], 0, 0, 'C');
        }

        $pdf->Cell(15, 6, $reserva['tipo_habitacion'], 0, 0, 'C');
        $pdf->Cell(70, 6, substr(utf8_decode($reserva['apellido1'].' '.$reserva['apellido2'].' '.$reserva['nombre1'].' '.$reserva['nombre2']), 0, 30), 0, 0, 'L');
        $pdf->Cell(25, 6, $reserva['fecha_llegada'], 0, 0, 'L');
        $pdf->Cell(25, 6, $reserva['fecha_salida'], 0, 0, 'L');
        $pdf->Cell(5, 6, $reserva['dias_reservados'], 0, 0, 'L');
        $pdf->Cell(5, 6, $reserva['can_hombres'], 0, 0, 'C');
        $pdf->Cell(5, 6, $reserva['can_mujeres'], 0, 0, 'C');
        $pdf->Cell(5, 6, $reserva['can_ninos'], 0, 0, 'C');
        $pdf->Cell(25, 6, number_format($reserva['valor_diario'], 2), 0, 1, 'R');
        if ($reserva['tipo_habitacion'] != 'CMA') {
            $hab = $hab + 1;
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

$pdf->Cell(45, 6, 'Habitaciones Disponibles', 1, 0, 'L');
$pdf->Cell(25, 6, $dispo, 1, 0, 'C');
$pdf->Cell(45, 6, 'Habitaciones Ocupadas', 1, 0, 'L');
$pdf->Cell(25, 6, $hab, 1, 0, 'C');
$pdf->Cell(25, 6, '% Ocupacion', 1, 0, 'L');
$pdf->Cell(25, 6, number_format(($hab / $dispo) * 100, 2).' %', 1, 1, 'C');
$pdf->Cell(30, 6, 'Total Huespedes', 1, 0, 'L');
$pdf->Cell(20, 6, $hom + $muj + $nin, 1, 0, 'C');
$pdf->Cell(25, 6, 'Hombres '.$hom, 1, 0, 'C');
$pdf->Cell(25, 6, 'Mujeres '.$muj, 1, 0, 'C');
$pdf->Cell(20, 6, utf8_decode('Niños ').$nin, 1, 0, 'C');
$pdf->Cell(40, 6, 'Ingreso Alojamiento', 1, 0, 'L');
$pdf->Cell(30, 6, number_format($tar, 2), 1, 1, 'C');

$pdf->Cell(65, 6, 'Ingreso Promedio por Habitacion Ocupada', 1, 0, 'L');
if ($hab == 0) {
    $pdf->Cell(30, 6, number_format($hab, 2), 1, 0, 'C');
} else {
    $pdf->Cell(30, 6, number_format(round($tar / $dispo, 0), 2), 1, 0, 'C');
}
$pdf->Cell(65, 6, 'Ingreso Promedio por Huesped', 1, 0, 'L');
if (($hom + $muj) == 0) {
    $pdf->Cell(30, 6, number_format($hom + $muj, 2), 1, 1, 'C');
} else {
    $pdf->Cell(30, 6, number_format(round($tar / ($hom + $muj), 0), 2), 1, 1, 'C');
}
$pdf->Cell(65, 6, 'Ingreso Promedio por Habitacion Disponibles', 1, 0, 'L');
$pdf->Cell(30, 6, number_format(round($tar / $dispo, 0), 2), 1, 0, 'C');

$file = '../../imprimir/auditorias/Huespedes_en_Casa_'.FECHA_PMS.'.pdf';
$pdf->Output($file, 'F');
