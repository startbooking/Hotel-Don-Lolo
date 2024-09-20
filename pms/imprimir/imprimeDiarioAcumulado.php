<?php

$cargos = $hotel->traeAcumuladoVentas(FECHA_PMS, $mes, $anio, 1);
$pagos = $hotel->traeAcumuladoVentas(FECHA_PMS, $mes, $anio, 3);

$pdf = new PDF();
$pdf->AddPage('L', 'letter');
$pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(260, 5, 'INFORME GENERAL VENTAS ', 0, 1, 'C');
$pdf->Cell(260, 4, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(70, 5, 'DESCRIPCION ', 1, 0, 'C');
$pdf->Cell(30, 5, 'VENTAS DIA', 1, 0, 'C');
$pdf->Cell(30, 5, 'IMPUESTO', 1, 0, 'C');
$pdf->Cell(30, 5, 'VENTAS MES', 1, 0, 'C');
$pdf->Cell(30, 5, 'IMPUESTO', 1, 0, 'C');   
$pdf->Cell(30, 5, 'VENTAS ANIO', 1, 0, 'C');
$pdf->Cell(30, 5, 'IMPUESTO', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$totingdia = 0;
$totimpdia = 0;
$totingmes = 0;
$totimpmes = 0;
$totingani = 0;
$totimpani = 0;

foreach ($cargos as $cargo) {
    $pdf->Cell(70, 6, (substr($cargo['descripcion_cargo'], 0, 30)), 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($cargo['cargoDia']+$cargo['cargoHisDia'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($cargo['imptoDia']+$cargo['imptoHisDia'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($cargo['cargoMes']+$cargo['cargoHisMes'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($cargo['imptoMes']+$cargo['imptoHisMes'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($cargo['cargoAnio']+$cargo['cargoHisAnio'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($cargo['imptoAnio']+$cargo['imptoHisAnio'], 2), 0, 1, 'R');

    $totingdia = $totingdia + $cargo['cargoDia']+$cargo['cargoHisDia'];
    $totimpdia = $totimpdia + $cargo['imptoDia']+$cargo['imptoHisDia'];
    $totingmes = $totingmes + $cargo['cargoMes']+$cargo['cargoHisMes'];
    $totimpmes = $totimpmes + $cargo['imptoMes']+$cargo['imptoHisMes'];
    $totingani = $totingani + $cargo['cargoAnio']+$cargo['cargoHisAnio'];
    $totimpani = $totimpani + $cargo['imptoAnio']+$cargo['imptoHisAnio'];
}

$pdf->Ln(3);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(70, 5, substr('TOTAL INGRESOS', 0, 30), 1, 0, 'L');
$pdf->Cell(30, 5, number_format($totingdia, 2), 1, 0, 'R');
$pdf->Cell(30, 5, number_format($totimpdia, 2), 1, 0, 'R');
$pdf->Cell(30, 5, number_format($totingmes, 2), 1, 0, 'R');
$pdf->Cell(30, 5, number_format($totimpmes, 2), 1, 0, 'R');
$pdf->Cell(30, 5, number_format($totingani, 2), 1, 0, 'R');
$pdf->Cell(30, 5, number_format($totimpani, 2), 1, 1, 'R');


$pdf->AddPage('P','letter');
  $pdf->SetFont('Arial', 'B', 11);
$pdf->Cell(160, 5, 'INFORME GENERAL PAGOS DEL DIA ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(160, 4, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 9);
$pdf->Ln(1);
$pdf->Cell(70, 5, 'DESCRIPCION ', 1, 0, 'C');
$pdf->Cell(30, 5, 'PAGOS DEL DIA', 1, 0, 'C');
$pdf->Cell(30, 5, 'PAGOS DEL MES', 1, 0, 'C');
$pdf->Cell(30, 5, 'PAGOS DEL ANIO', 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);

$totpagdia = 0;
$totpagmes = 0;
$totpagani = 0;

foreach ($pagos as $pago) {
    $pdf->Cell(70, 4, (substr($pago['descripcion_cargo'], 0, 30)), 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($pago['pagosDia']+$pago['pagosHisDia'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($pago['pagosMes']+$pago['pagosHisMes'], 2), 0, 0, 'R');
    $pdf->Cell(30, 4, number_format($pago['pagosAnio']+$pago['pagosHisAnio'], 2), 0, 1, 'R');
    $totpagdia = $totpagdia + $pago['pagosDia']+$pago['pagosHisDia'];
    $totpagmes = $totpagmes + $pago['pagosMes']+$pago['pagosHisMes'];
    $totpagani = $totpagani + $pago['pagosAnio']+$pago['pagosHisAnio']; 
}
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 9);

$pdf->Cell(70, 5, (substr('TOTAL PAGOS RECIBIDOS', 0, 30)), 1, 0, 'L');
$pdf->Cell(30, 5, number_format($totpagdia, 2), 1, 0, 'R');
$pdf->Cell(30, 5, number_format($totpagmes, 2), 1, 0, 'R');
$pdf->Cell(30, 5, number_format($totpagani, 2), 1, 1, 'R');
$pdf->Ln(3);

$file = '../../imprimir/auditorias/Balance_DiarioAcumulado_'.FECHA_PMS.'.pdf'; // linea real

$pdf->Output($file, 'F');
