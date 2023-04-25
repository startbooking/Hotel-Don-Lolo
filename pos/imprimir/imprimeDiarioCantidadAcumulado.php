<?php

require_once '../../res/fpdf/fpdf.php';

$pdf = new FPDF();
$pdf->AddPage('P', 'letter');
$pdf->Image('../../img/'.$logo, 10, 10, 15);
$pdf->SetFont('Arial', 'B', 13);
$pdf->Cell(195, 6, $nomamb, 0, 1, 'C');
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(195, 5, 'ACUMULADO DE PRODUCTOS  ', 0, 1, 'C');
$pdf->SetFont('Arial', '', 10);
$pdf->Cell(195, 6, 'Fecha : '.$fecha, 0, 1, 'C');
$pdf->Ln(1);
$pdf->SetFont('Arial', 'B', 9);
$pdf->Cell(60, 5, 'PRODUCTO ', 1, 0, 'C');
$pdf->Cell(30, 5, 'PRECIO. ', 1, 0, 'C');
$pdf->Cell(20, 5, 'CANT. ', 1, 0, 'C');
$pdf->Cell(20, 5, 'CANT MES', 1, 0, 'C');
$pdf->Cell(20, 5, utf8_decode('CANT AÑO'), 1, 1, 'C');
$pdf->SetFont('Arial', '', 9);
$pdf->Ln(1);

$totingdia = 0;
$totingmes = 0;
$totingani = 0; 

$diavta = $pos->acumuladoDiarioProductosVendidos($idamb, $fecha);
$mesvta = $pos->acumuladoMesProductosVendidos($idamb, $anio, $mes);
$aniovta = $pos->acumuladoAnioProductosVendidos($idamb, $anio);

$productos = $pos->productoPOS($idamb);

foreach ($productos as $producto) {
    $idprod = $producto['producto_id'];
    $nomdia = array_search($idprod, array_column($diavta, 'producto_id'));
    $nommes = array_search($idprod, array_column($mesvta, 'producto_id'));
    $nomanio = array_search($idprod, array_column($aniovta, 'producto_id'));

    $pdf->Cell(60, 4, utf8_decode(substr($producto['nom'], 0, 28)), 0, 0, 'L');
    $pdf->Cell(30, 4, number_format($producto['venta'], 2), 0, 0, 'R');

    if ($nomdia != '') {
        $pdf->Cell(20, 4, number_format($diavta[$nomdia]['cant'], 0), 0, 0, 'R');
        $totingdia = $totingdia + $diavta[$nomdia]['cant'];
    } else {
        $pdf->Cell(20, 4, number_format(0, 0), 0, 0, 'R');
    }
    if ($nommes != '') {
        $pdf->Cell(20, 4, number_format($mesvta[$nommes]['cantmes'], 0), 0, 0, 'R');
        $totingmes = $totingmes + $mesvta[$nommes]['cantmes'];
    } else {
        $pdf->Cell(20, 4, number_format(0, 0), 0, 0, 'R');
    }

    if ($nomanio != '') {
        $pdf->Cell(20, 4, number_format($aniovta[$nomanio]['cantanio'], 0), 0, 1, 'R');
        $totingani = $totingani + $aniovta[$nomanio]['cantanio'];
    } else {
        $pdf->Cell(20, 4, number_format(0, 0), 0, 1, 'R');
    }
}

$pdf->Ln(3);

$file = '../imprimir/auditorias/acumuladoDiarioProductos_'.$pref.'_'.$fecha.'.pdf';
$pdf->Output($file, 'F');
