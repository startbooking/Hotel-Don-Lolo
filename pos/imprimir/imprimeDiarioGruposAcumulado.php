<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('L', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(260, 5, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(260, 5, 'VENTAS ACUMULADAS POR GRUPOS DE VENTAS ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 11);
$pdf->Cell(260, 4, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(4);
$pdf->SetFont('Arial', '', 9);
$pdf->Cell(60, 5, 'GRUPO ', 0, 0, 'C');
$pdf->Cell(20, 5, 'CANT. ', 0, 0, 'C');
$pdf->Cell(20, 5, 'IMPUESTO', 0, 0, 'C');
$pdf->Cell(20, 5, 'VENTAS DIA', 0, 0, 'C');
$pdf->Cell(20, 5, 'CANT MES', 0, 0, 'C');
$pdf->Cell(25, 5, 'IMPUESTO', 0, 0, 'C');
$pdf->Cell(25, 5, 'VENTAS MES', 0, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('CANT AÑO'), 0, 0, 'C');
$pdf->Cell(25, 5, 'IMPUESTO', 0, 0, 'C');
$pdf->Cell(25, 5, utf8_decode('VENTAS AÑO'), 0, 1, 'C');

$codigos = $pos->getSeccionesPos($idamb);

$totingdia = 0;
$totimpdia = 0;
$totvendia = 0;
$totingmes = 0;
$totimpmes = 0;
$totvenmes = 0;
$totingani = 0;
$totimpani = 0;
$totvenani = 0;
$diavta = $pos->getVentasDiaGrupos($fecha, $idamb);
$mesvta = $pos->getVentasMesGrupos($anio, $mes, $idamb);
$aniovta = $pos->getVentasAnioGrupos($anio, $idamb);

foreach ($codigos as $codigo) {
    $idgrupo = $codigo['id_seccion'];

    $nomdia = array_search($idgrupo, array_column($diavta, 'id_seccion'));
    $nommes = array_search($idgrupo, array_column($mesvta, 'id_seccion'));
    $nomanio = array_search($idgrupo, array_column($aniovta, 'id_seccion'));

    $pdf->Cell(60, 4, utf8_decode(substr($codigo['nombre_seccion'], 0, 30)), 0, 0, 'L');

    if ($nomdia != '') {
        $pdf->Cell(20, 4, number_format($diavta[$nomdia]['cant'], 0), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($diavta[$nomdia]['imptos'], 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format($diavta[$nomdia]['ventas'], 2), 0, 0, 'R');
        $totingdia = $totingdia + $diavta[$nomdia]['cant'];
        $totimpdia = $totimpdia + $diavta[$nomdia]['imptos'];
        $totvendia = $totvendia + $diavta[$nomdia]['ventas'];
    } else {
        $pdf->Cell(20, 4, number_format(0, 0), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format(0, 2), 0, 0, 'R');
        $pdf->Cell(20, 4, number_format(0, 2), 0, 0, 'R');
    }
    if ($nommes != '') {
        $pdf->Cell(20, 4, number_format($mesvta[$nommes]['cantmes'], 0), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($mesvta[$nommes]['imptosmes'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($mesvta[$nommes]['ventasmes'], 2), 0, 0, 'R');
        $totingmes = $totingmes + $mesvta[$nommes]['cantmes'];
        $totimpmes = $totimpmes + $mesvta[$nommes]['imptosmes'];
        $totvenmes = $totvenmes + $mesvta[$nommes]['ventasmes'];
    } else {
        $pdf->Cell(20, 4, number_format(0, 0), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format(0, 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format(0, 2), 0, 0, 'R');
    }

    if ($nomanio != '') {
        $pdf->Cell(20, 4, number_format($aniovta[$nomanio]['cantanio'], 0), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($aniovta[$nomanio]['imptosanio'], 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format($aniovta[$nomanio]['ventasanio'], 2), 0, 1, 'R');
        $totingani = $totingani + $aniovta[$nomanio]['cantanio'];
        $totimpani = $totimpani + $aniovta[$nomanio]['imptosanio'];
        $totvenani = $totvenani + $aniovta[$nomanio]['ventasanio'];
    } else {
        $pdf->Cell(20, 4, number_format(0, 0), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format(0, 2), 0, 0, 'R');
        $pdf->Cell(25, 4, number_format(0, 2), 0, 1, 'R');
    }
}

$pdf->Ln(3);
$pdf->SetFont('Arial', 'b', 10);

$pdf->Cell(60, 6, utf8_decode(substr('TOTAL INGRESOS', 0, 30)), 0, 0, 'L');
$pdf->Cell(20, 6, number_format($totingdia, 0), 0, 0, 'R');
$pdf->Cell(20, 6, number_format($totimpdia, 2), 0, 0, 'R');
$pdf->Cell(20, 6, number_format($totvendia, 2), 0, 0, 'R');
$pdf->Cell(20, 6, number_format($totingmes, 0), 0, 0, 'R');
$pdf->Cell(25, 6, number_format($totimpmes, 2), 0, 0, 'R');
$pdf->Cell(25, 6, number_format($totvenmes, 2), 0, 0, 'R');
$pdf->Cell(20, 6, number_format($totingani, 0), 0, 0, 'R');
$pdf->Cell(25, 6, number_format($totimpani, 2), 0, 0, 'R');
$pdf->Cell(25, 6, number_format($totvenani, 2), 0, 1, 'R');

$pdf->Ln(3);
$pdf->SetFont('Arial', '', 9);

$file = '../imprimir/auditorias/acumuladoDiarioGrupos_'.$pref.'_'.$fecha.'.pdf';
$pdf->Output($file, 'F');
