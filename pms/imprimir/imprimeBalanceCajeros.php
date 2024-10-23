<?php 


$usuarios = $hotel->getUsuariosCargos(FECHA_PMS, 1);
// $regis = count($usuarios);
// echo print_r($usuarios);

$pdf = new PDF();
$pdf->AddPage('P', 'letter');
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(195, 5, 'BALANCE CAJERO '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(2);

foreach ($usuarios as $usuario) {
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(30, 5, 'Usuario ', 1, 0, 'L');
    $pdf->Cell(50, 5, ($usuario['apellidos'].' '.$usuario['nombres']), 1, 1, 'C');
    $pdf->Cell(195, 5, 'CARGOS DEL DIA '.FECHA_PMS, 0, 1, 'C');
    $pdf->Cell(10, 5, 'Hab.', 0, 0, 'C');
    $pdf->Cell(50, 5, 'Huesped', 0, 0, 'C');
    $pdf->Cell(40, 5, 'Descripcion ', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Cant. ', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Monto', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Impuesto', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Total', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Hora', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    $cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS, $usuario['usuario'], 1, 0);
    $monto = 0;
    $impto = 0;
    $total = 0;
    foreach ($cargos as $cargo) {
        $pdf->Cell(10, 4, $cargo['habitacion_cargo'], 0, 0, 'L');
        $pdf->Cell(50, 4, substr(($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 24), 0, 0, 'L');
        $pdf->Cell(40, 4, substr(($cargo['descripcion_cargo']), 0, 19), 0, 0, 'L');
        $pdf->Cell(10, 4, $cargo['cantidad_cargo'], 0, 0, 'C');
        $pdf->Cell(25, 4, number_format($cargo['monto_cargo'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($cargo['impuesto'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($cargo['monto_cargo'] + $cargo['impuesto'], 2), 0, 0, 'R');
        $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
        $monto = $monto + $cargo['monto_cargo'];
        $impto = $impto + $cargo['impuesto'];
        $total = $total + $cargo['monto_cargo'] + $cargo['impuesto'];
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(110, 5, 'Total cargos Por Cajero ', 0, 0, 'L');
    $pdf->Cell(25, 5, number_format($monto, 2), 0, 0, 'R');
    $pdf->Cell(25, 5, number_format($impto, 2), 0, 0, 'R');
    $pdf->Cell(25, 5, number_format($total, 2), 0, 1, 'R');
    $pdf->Ln(3);
    $pdf->Cell(195, 5, 'CARGOS ANULADOS DEL DIA '.FECHA_PMS, 0, 1, 'C');
    $pdf->Ln(2);
    $pdf->Cell(10, 5, 'Hab.', 0, 0, 'C');
    $pdf->Cell(40, 5, 'Descripcion ', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Cant. ', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Monto', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Impuesto', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Total', 0, 0, 'C');
    $pdf->Cell(50, 5, 'Motivo An', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Hora', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    $cargos = $hotel->getCargosAnuladosdelDiaporcajero(FECHA_PMS, $usuario['usuario'], 1, 1);
    $monto = 0;
    $impto = 0;
    $total = 0;
    foreach ($cargos as $cargo) {
        $pdf->Cell(10, 5, $cargo['habitacion_cargo'], 0, 0, 'L');
        $pdf->Cell(40, 5, substr($cargo['descripcion_cargo'], 0, 19), 0, 0, 'L');
        $pdf->Cell(10, 5, $cargo['cantidad_cargo'], 0, 0, 'C');
        $pdf->Cell(25, 5, number_format($cargo['monto_cargo'], 2), 0, 0, 'R');
        $pdf->Cell(25, 5, number_format($cargo['impuesto'], 2), 0, 0, 'R');
        $pdf->Cell(25, 5, number_format($cargo['monto_cargo'] + $cargo['impuesto'], 2), 0, 0, 'R');
        $pdf->Cell(50, 5, $cargo['motivo_anulacion'], 0, 0, 'L');
        $pdf->Cell(10, 5, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
        $monto = $monto + $cargo['monto_cargo'];
        $impto = $impto + $cargo['impuesto'];
        $total = $total + $cargo['monto_cargo'] + $cargo['impuesto'];
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(110, 5, 'Total Cargos Anulados Cajero ', 0, 0, 'L');
    $pdf->Cell(25, 5, number_format($monto, 2), 0, 0, 'R');
    $pdf->Cell(25, 5, number_format($impto, 2), 0, 0, 'R');
    $pdf->Cell(25, 5, number_format($total, 2), 0, 1, 'R');
    $pdf->Ln(3);

    $pdf->Cell(195, 5, 'PAGOS DEL DIA '.FECHA_PMS, 0, 1, 'C');
    $pdf->Cell(10, 5, 'Hab.', 0, 0, 'C');
    $pdf->Cell(50, 5, 'Huesped', 0, 0, 'C');
    $pdf->Cell(40, 5, 'Descripcion ', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Valor', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Hora', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    $cargos = $hotel->getCargosdelDiaporcajero(FECHA_PMS, $usuario['usuario'], 3, 0);
    $pagos = 0;
    foreach ($cargos as $cargo) {
        $pdf->Cell(10, 4, $cargo['habitacion_cargo'], 0, 0, 'L');
        $pdf->Cell(50, 4, substr(($cargo['apellido1'].' '.$cargo['apellido2'].' '.$cargo['nombre1'].' '.$cargo['nombre2']), 0, 24), 0, 0, 'L');
        $pdf->Cell(40, 4, substr($cargo['descripcion_cargo'], 0, 19), 0, 0, 'L');
        $pdf->Cell(25, 4, number_format($cargo['pagos_cargos'], 2), 0, 0, 'R');
        $pdf->Cell(10, 4, substr($cargo['fecha_sistema_cargo'], 11, 5), 0, 1, 'R');
        $pagos = $pagos + $cargo['pagos_cargos'];
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(100, 5, 'Total Pagos Por Cajero ', 0, 0, 'L');
    $pdf->Cell(25, 5, number_format($pagos, 2), 0, 1, 'R');
    $pdf->Ln(5);

    $pdf->Cell(195, 5, 'PAGOS ANULADOS DEL DIA '.FECHA_PMS, 0, 1, 'C');
    $pdf->Cell(10, 5, 'Hab.', 0, 0, 'C');
    $pdf->Cell(50, 5, 'Huesped', 0, 0, 'C');
    $pdf->Cell(40, 5, 'Descripcion ', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Valor', 0, 0, 'C');
    $pdf->Cell(50, 5, 'Motivo Anulacion', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    $cargos = $hotel->getCargosAnuladosdelDiaporcajero(FECHA_PMS, $usuario['usuario'], 3, 1);
    $pagosanu = 0;
    $impto = 0;
    $total = 0;
    foreach ($cargos as $cargo) {
        $pdf->Cell(10, 4, $cargo['habitacion_cargo'], 0, 0, 'L');
        $pdf->Cell(50, 4, substr(($cargo['nombre_completo']), 0, 24), 0, 0, 'L');
        $pdf->Cell(40, 4, substr($cargo['descripcion_cargo'], 0, 19), 0, 0, 'L');
        $pdf->Cell(25, 4, number_format($cargo['pagos_cargos'], 2), 0, 0, 'R');
        $pdf->Cell(50, 4, substr(($cargo['motivo_anulacion']), 0, 35), 0, 1, 'L');
        $pagosanu = $pagosanu + $cargo['pagos_cargos'];
    }
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(100, 5, 'Total Pagos Anulados Cajero ', 0, 0, 'L');
    $pdf->Cell(25, 5, number_format($pagosanu, 2), 0, 1, 'R');
    $pdf->Ln(5);
    $pdf->Cell(195, 5, 'DEPOSITOS DEL DIA ', 0, 1, 'C');
    $pdf->Ln(2);
    $pdf->Cell(10, 5, 'Hab.', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Nro.', 0, 0, 'C');
    $pdf->Cell(70, 5, 'Huesped', 0, 0, 'C');
    $pdf->Cell(50, 5, 'Descripcion ', 0, 0, 'C');
    $pdf->Cell(25, 5, 'Valor', 0, 0, 'C');
    $pdf->Cell(10, 5, 'Hora', 0, 1, 'C');
    $pdf->SetFont('Arial', '', 9);
    $cargos = $hotel->getDepositosdelDiaporcajero(FECHA_PMS, $usuario['usuario'], 3, 0);

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
    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(130, 5, 'Total Pagos Por Cajero ', 0, 0, 'L');
    $pdf->Cell(25, 5, number_format($pagos, 2), 0, 1, 'R');

    $pdf->Ln(5);
}

$file = '../../imprimir/auditorias/Balance_Cajeros_'.FECHA_PMS.'.pdf';
$pdf->Output($file, 'F');
