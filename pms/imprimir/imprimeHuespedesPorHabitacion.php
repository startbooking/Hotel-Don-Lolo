<?php

$file = $_POST['file'];
$usuario = $_POST['usuario'];
$apellidos = $_POST['apellidos'];
$nombres = $_POST['nombres'];

require_once '../../res/php/app_topHotel.php';
require_once '../imprimir/plantillaFpdfRooms.php';

$reservas = $hotel->getHuespedesenCasa(2, 'CA');
// echo print_r($reservas);

$room = $hotel->cantidadHabitaciones(1);
$pm = $hotel->cantidadHabitaciones(5);
$rooms = count($room);
array_sort_by($reservas, 'num_habitacion', $order = SORT_ASC);
$regis = count($reservas);
$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(190, 4, 'HUESPEDES EN CASA POR HABITACION', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(190, 4, 'Fecha: '.FECHA_PMS, 0, 1, 'C');
// $pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(10, 5, 'Hab.', 1, 0, 'C');
$pdf->Cell(70, 5, 'Huesped', 1, 0, 'C');
$pdf->Cell(25, 5, 'Llegada', 1, 0, 'C');
$pdf->Cell(25, 5, 'Salida', 1, 0, 'C');
$pdf->Cell(5, 5, 'H', 1, 0, 'L');
$pdf->Cell(5, 5, 'M', 1, 0, 'L');
$pdf->Cell(5, 5, 'N', 1, 0, 'L');
$pdf->Cell(25, 5, 'Tarifa', 1, 0, 'C');
$pdf->Cell(15, 5, 'Registro ', 1, 1, 'C');
// $pdf->Cell(20, 5, 'Est. ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$hab = 0;
$hom = 0;
$muj = 0;
$nin = 0;
$tar = 0;
if ($regis == 0) {
    $pdf->Cell(190, 5, 'SIN HUESPEDES EN CASA ', 0, 0, 'C');
} else {
    foreach ($reservas as $reserva) {
        $pdf->Cell(10, 4, $reserva['num_habitacion'], 0, 0, 'L');
        $pdf->Cell(70, 4, substr(($reserva['nombre_completo']), 0, 34), 0, 0, 'L');
        $pdf->Cell(25, 4, $reserva['fecha_llegada'], 0, 0, 'L');
        $pdf->Cell(25, 4, $reserva['fecha_salida'], 0, 0, 'L');
        $pdf->Cell(5, 4, $reserva['can_hombres'], 0, 0, 'C');
        $pdf->Cell(5, 4, $reserva['can_mujeres'], 0, 0, 'C');
        $pdf->Cell(5, 4, $reserva['can_ninos'], 0, 0, 'C');
        $pdf->Cell(25, 4, number_format($reserva['valor_diario'], 2), 0, 0, 'R');
        $pdf->Cell(15, 4, $reserva['num_registro'], 0, 1, 'R');
        // $pdf->Cell(20, 5, $reserva['estado'], 0, 1, 'C');
        $acompanantes = $hotel->getBuscarAcompanantesReserva($reserva['num_reserva']);
        if (count($acompanantes) != 0) {
            foreach ($acompanantes as $acompanante) {
                $pdf->Cell(10, 4, '', 0, 0, 'L');
                $pdf->Cell(70, 4, ($acompanante['apellido1'].' '.$acompanante['apellido2'].' '.$acompanante['nombre1'].' '.$acompanante['nombre2']), 0, 1, 'L');
            }
        }
        if ($reserva['tipo_habitacion'] != '1') {
            $hab = $hab + 1;
            $hom = $hom + $reserva['can_hombres'];
            $muj = $muj + $reserva['can_mujeres'];
            $nin = $nin + $reserva['can_ninos'];
            $tar = $tar + $reserva['valor_diario'];
        }
    }
}
$pdf->Rect(10, 239, 190, 20);
$pdf->SetY(239);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(45, 5, 'Habitaciones Disponibles', 1, 0, 'L');
$pdf->Cell(25, 5, $rooms, 1, 0, 'C');
$pdf->Cell(45, 5, 'Habitaciones Ocupadas', 1, 0, 'L');
$pdf->Cell(25, 5, $hab, 1, 0, 'C');
$pdf->Cell(25, 5, '% Ocupacion', 1, 0, 'L');
$pdf->Cell(25, 5, number_format(($hab / $rooms) * 100, 2).' %', 1, 1, 'C');
$pdf->Cell(30, 5, 'Total Huespedes', 1, 0, 'L');
$pdf->Cell(20, 5, $hom + $muj + $nin, 1, 0, 'C');
$pdf->Cell(25, 5, 'Hombres '.$hom, 1, 0, 'C');
$pdf->Cell(25, 5, 'Mujeres '.$muj, 1, 0, 'C');
$pdf->Cell(20, 5, ('Niños ').$nin, 1, 0, 'C');
$pdf->Cell(40, 5, 'Ingreso Alojamiento', 1, 0, 'L');
$pdf->Cell(30, 5, number_format($tar, 2), 1, 1, 'C');
$pdf->Cell(65, 5, 'Ingreso Promedio por Habitacion Ocupada', 1, 0, 'L');
if ($hab == 0) {
    $pdf->Cell(30, 5, number_format($hab, 2), 1, 0, 'C');
} else {
    $pdf->Cell(30, 5, number_format($tar / $hab, 2), 1, 0, 'C');
}
$pdf->Cell(65, 5, 'Ingreso Promedio por Huesped', 1, 0, 'L');
if (($hom + $muj) == 0) {
    $pdf->Cell(30, 5, number_format($hom + $muj, 2), 1, 1, 'C');
} else {
    $pdf->Cell(30, 5, number_format($tar / ($hom + $muj), 2), 1, 1, 'C');
}  $pdf->Cell(65, 5, 'Ingreso Promedio por Habitacion Disponibles', 1, 0, 'L');
$pdf->Cell(30, 5, number_format($tar / $rooms, 2), 1, 0, 'C');

$pdfFile = $pdf->Output('', 'S');
$base64String = chunk_split(base64_encode($pdfFile));

echo $base64String;
