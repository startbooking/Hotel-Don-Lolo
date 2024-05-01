<?php

$anio = substr(FECHA_PMS, 0, 4);
$mes = substr(FECHA_PMS, 5, 2);

$pdf = new PDF();
$pdf->AddPage('L', 'letter');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(260, 5, 'INFORME GENERAL VENTAS ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(260, 4, 'Fecha : '.FECHA_PMS, 0, 1, 'C');
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(70, 5, 'DESCRIPCION ', 0, 0, 'C');
$pdf->Cell(30, 5, 'VENTAS DIA', 0, 0, 'C');
$pdf->Cell(30, 5, 'IMPUESTO', 0, 0, 'C');
$pdf->Cell(30, 5, 'VENTAS MES', 0, 0, 'C');
$pdf->Cell(30, 5, 'IMPUESTO', 0, 0, 'C');
$pdf->Cell(30, 5, utf8_decode('VENTAS AÑO'), 0, 0, 'C');
$pdf->Cell(30, 5, utf8_decode('IMPUESTO'), 0, 1, 'C');

$codigos = $hotel->getCodigosConsumos(1);
$totingdia = 0;
$totimpdia = 0;
$totingmes = 0;
$totimpmes = 0;
$totingani = 0;
$totimpani = 0;

foreach ($codigos as $codigo) {
    $pdf->Cell(70, 6, utf8_decode(substr($codigo['descripcion_cargo'], 0, 30)), 0, 0, 'L');
    $diavta = $hotel->getVentasDiaCodigo(FECHA_PMS, $codigo['id_cargo']);
    $mesvtaact = $hotel->getVentasMesCodigo($mes, $anio, $codigo['id_cargo']);
    $mesvtahis = $hotel->getVentasMesCodigoHistorico($mes, $anio, $codigo['id_cargo']);
    $aniovtaact = $hotel->getVentasAnioCodigo($anio, $codigo['id_cargo']);
    $aniovtahis = $hotel->getVentasAnioCodigoHistorico($anio, $codigo['id_cargo']);
    if ($diavta[0]['cargos'] == '') {
        $cargos = 0;
    } else {
        $cargos = $diavta[0]['cargos'];
    }
    if ($diavta[0]['imptos'] == '') {
        $impto = 0;
    } else {
        $impto = $diavta[0]['imptos'];
    }

    if (count($mesvtaact) == 0) {
        $carmes = 0;
    } else {
        $carmes = $mesvtaact[0]['cargos'];
    }
    if (count($mesvtahis) == 0) {
        $caracu = 0;
    } else {
        $caracu = $mesvtahis[0]['cargos'];
    }
    if (count($mesvtaact) == 0) {
        $impmes = 0;
    } else {
        $impmes = $mesvtaact[0]['imptos'];
    }
    if (count($mesvtahis) == 0) {
        $impacu = 0;
    } else {
        $impacu = $mesvtahis[0]['imptos'];
    }
    if (count($aniovtaact) == 0) {
        $carani = 0;
    } else {
        $carani = $aniovtaact[0]['cargos'];
    }
    if (count($aniovtahis) == 0) {
        $caracuani = 0;
    } else {
        $caracuani = $aniovtahis[0]['cargos'];
    }
    if (count($aniovtaact) == 0) {
        $impani = 0;
    } else {
        $impani = $aniovtaact[0]['imptos'];
    }
    if (count($aniovtahis) == 0) {
        $impacuani = 0;
    } else {
        $impacuani = $aniovtahis[0]['imptos'];
    }
    $pdf->Cell(30, 6, number_format($cargos, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format($impto, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format($carmes + $caracu, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format($impmes + $impacu, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format($carani + $caracuani, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format($impani + $impacuani, 2), 0, 1, 'R');

    $totingdia = $totingdia + $cargos;
    $totimpdia = $totimpdia + $impto;
    $totingmes = $totingmes + $carmes + $caracu;
    $totimpmes = $totimpmes + $impmes + $impacu;
    $totingani = $totingani + $carani + $caracuani;
    $totimpani = $totimpani + $impani + $impacuani;
}

$pdf->Ln(3);
$pdf->SetFont('Arial', 'b', 10);

$pdf->Cell(70, 6, utf8_decode(substr('TOTAL INGRESOS', 0, 30)), 0, 0, 'L');
$pdf->Cell(30, 6, number_format($totingdia, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totimpdia, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totingmes, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totimpmes, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totingani, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totimpani, 2), 0, 1, 'R');

$pdf->Ln(3);
$pdf->SetFont('Arial', '', 9);

$pagos = $hotel->getCodigosConsumos(3);
$totingdia = 0;
$totimpdia = 0;
$totingmes = 0;
$totimpmes = 0;
$totingani = 0;
$totimpani = 0;

foreach ($pagos as $pago) {
    $pdf->Cell(70, 6, utf8_decode(substr($pago['descripcion_cargo'], 0, 30)), 0, 0, 'L');
    $diavta = $hotel->getVentasDiaCodigo(FECHA_PMS, $pago['id_cargo']);
    $mesvtaact = $hotel->getVentasMesCodigo($mes, $anio, $pago['id_cargo']);
    $mesvtahis = $hotel->getVentasMesCodigoHistorico($mes, $anio, $pago['id_cargo']);
    $aniovtaact = $hotel->getVentasAnioCodigo($anio, $pago['id_cargo']);
    $aniovtahis = $hotel->getVentasAnioCodigoHistorico($anio, $pago['id_cargo']);
    if ($diavta[0]['pagos'] == '') {
        $cargos = 0;
    } else {
        $cargos = $diavta[0]['pagos'];
    }
    if (count($mesvtaact) == 0) {
        $carmes = 0;
    } else {
        $carmes = $mesvtaact[0]['pagos'];
    }
    if (count($mesvtahis) == 0) {
        $caracu = 0;
    } else {
        $caracu = $mesvtahis[0]['pagos'];
    }
    if (count($aniovtaact) == 0) {
        $carani = 0;
    } else {
        $carani = $aniovtaact[0]['pagos'];
    }
    if (count($aniovtahis) == 0) {
        $caracuani = 0;
    } else {
        $caracuani = $aniovtahis[0]['pagos'];
    }
    $pdf->Cell(30, 6, number_format($cargos, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format(0, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format($carmes + $caracu, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format(0, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format($carani + $caracuani, 2), 0, 0, 'R');
    $pdf->Cell(30, 6, number_format(0, 2), 0, 1, 'R');
    $totingdia = $totingdia + $cargos;
    $totimpdia = $totimpdia + $impto;
    $totingmes = $totingmes + $carmes + $caracu;
    $totimpmes = $totimpmes + $impmes + $impacu;
    $totingani = $totingani + $carani + $caracuani;
    $totimpani = $totimpani + $impani + $impacuani;
}
$pdf->Ln(3);
$pdf->SetFont('Arial', 'b', 10);

$pdf->Cell(70, 6, utf8_decode(substr('TOTAL PAGOS RECIBIDOS', 0, 30)), 0, 0, 'L');
$pdf->Cell(30, 6, number_format($totingdia, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totimpdia, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totingmes, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totimpmes, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totingani, 2), 0, 0, 'R');
$pdf->Cell(30, 6, number_format($totimpani, 2), 0, 1, 'R');

$pdf->Ln(3);
$pdf->SetFont('Arial', '', 9);

$file = '../../imprimir/auditorias/Balance_DiarioAcumulado_'.FECHA_PMS.'.pdf';
$pdf->Output($file, 'F');
